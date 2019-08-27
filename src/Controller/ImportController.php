<?php

namespace App\Controller;

use App\Entity\AgeGroup;
use App\Entity\AncestralTrait;
use App\Entity\Ancestry;
use App\Entity\Armor;
use App\Entity\BuildType;
use App\Entity\ChaosAlignment;
use App\Entity\Character;
use App\Entity\Complexion;
use App\Entity\Dooming;
use App\Entity\Drawback;
use App\Entity\EyeColor;
use App\Entity\HairColor;
use App\Entity\Height;
use App\Entity\OrderAlignment;
use App\Entity\Profession;
use App\Entity\Season;
use App\Entity\SocialClass;
use App\Entity\Upbringing;
use App\Entity\Weight;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ImportController extends AbstractController
{
    private const BATCH_SIZE = 20;

    /**
     * @Route("/import", name="import", methods={"POST"})
     */
    public function importCSV(Request $request, EntityManagerInterface $entityManager)
    {
        if (!$request->files->has('data')) {
            throw new BadRequestHttpException();
        }
        /** @var \SplFileObject $dataFile */
        $dataFile = $request->files->get('data')->openFile();
        $headers = $dataFile->fgetcsv();
        $i = 2;
        while (!$dataFile->eof()) {
            $data = $dataFile->fgetcsv();
            if (array(null) === $data) {
                continue; //skip blank line
            }

            $data = array_combine($headers, $data);
            try {
                $newCharacter = $this->createCharacterWithReference($data, $entityManager);
                $entityManager->persist($newCharacter);
                if (0 === $i % self::BATCH_SIZE) {
                    $entityManager->flush();
                    $entityManager->clear(Character::class);
                }
                $i++;
            } catch (ORMException $e) {
                throw new BadRequestHttpException(sprintf("Invalid Character on line %s", $i), $e);
            }
        }
        $entityManager->flush();
        $entityManager->clear(Character::class);
        return new Response(sprintf('Now there are %s Character(s) into the DB', $entityManager->getRepository(Character::class)->count([])));
    }

    /**
     * @throws ORMException
     */
    private function createCharacterWithReference(array $data, EntityManagerInterface $entityManager): Character
    {
        return new Character(
            $entityManager->getReference(Ancestry::class, $data['ancestry']),
            $entityManager->getReference(AncestralTrait::class, $data['ancestralTrait']),
            $data['sex'],
            $entityManager->getReference(Profession::class, $data['profession']),
            $entityManager->getReference(BuildType::class, $data['buildType']),
            $entityManager->getReference(Complexion::class, $data['complexion']),
            $entityManager->getReference(EyeColor::class, $data['eyeColor']),
            $entityManager->getReference(HairColor::class, $data['hairColor']),
            $entityManager->getReference(Height::class, $data['height']),
            $entityManager->getReference(Weight::class, $data['weight']),
            $entityManager->getReference(AgeGroup::class, $data['ageGroup']),
            explode('|', $data['distinguishingMarks']),
            $entityManager->getReference(Season::class, $data['seasonOfBirth']),
            $entityManager->getReference(Dooming::class, $data['dooming']),
            $entityManager->getReference(ChaosAlignment::class, $data['chaosAlignment']),
            $entityManager->getReference(OrderAlignment::class, $data['orderAlignment']),
            $data['drawback'] ? $entityManager->getReference(Drawback::class, $data['drawback']) : null,
            $entityManager->getReference(SocialClass::class, $data['socialClass']),
            $entityManager->getReference(Upbringing::class, $data['upbringing']),
            $data['combat'],
            $data['brawn'],
            $data['agility'],
            $data['perception'],
            $data['intelligence'],
            $data['willpower'],
            $data['fellowship'],
            $data['trappings'],
            $entityManager->getReference(Armor::class, $data['armor']),
            $data['name']
        );
    }

    /**
     * @Route("/replace", name="replace", methods={"POST"})
     */
    public function replace(Request $request, EntityManagerInterface $entityManager)
    {
        if (!$request->files->has('data')) {
            throw new BadRequestHttpException();
        }
        /** @var \SplFileObject $dataFile */
        $dataFile = $request->files->get('data')->openFile();
        $headers = $dataFile->fgetcsv();

        $meta = $entityManager->getClassMetadata(Character::class);
        $query = $this->createInsertQueryString($meta, $properties);
        dump($query);
        $connection = $entityManager->getConnection();
        $i = 2;
        while (!$dataFile->eof()) {
            $data = $dataFile->fgetcsv();
            if (array(null) === $data) {
                continue; //skip blank line
            }

            $data = array_combine($headers, $data);
            try {
                $newCharacter = $this->createCharacterWithReference($data, $entityManager);
                $rProperty = $meta->getReflectionProperty('id');
                $rProperty->setAccessible(true);
                $rProperty->setValue($newCharacter, $data['id']);
                $data = array_combine($properties, array_map(function ($property) use ($meta, $newCharacter) {
                    $rProperty = $meta->getReflectionProperty($property);
                    $rProperty->setAccessible(true);
                    $value  = $rProperty->getValue($newCharacter);
                    return is_object($value) ? $value->getId() : (is_array($value) ? json_encode($value) : $value);
                }, $properties));
                dump($data);
                $stmt = $connection->prepare($query);
                $stmt->execute($data);
                $i++;
            } catch (ORMException|DBALException $e) {
                throw new BadRequestHttpException(sprintf("Invalid Character on line %s", $i), $e);
            }
        }
        return new Response(sprintf('Now there are %s Character(s) into the DB', $entityManager->getRepository(Character::class)->count([])));
    }

    private function createInsertQueryString(ClassMetadata $meta, &$properties = []): string
    {
        // create the query string!
        $insertTemplate = 'INSERT INTO %s (%s) VALUES (%s) ON DUPLICATE KEY UPDATE %s;';

        // escape silly table name
        $tableName = '`' . $meta->getTableName() . '`';

        // get the obj properties
        $properties = array_keys($meta->getReflectionProperties());

        // filter properties that aren't column
        $properties = array_filter($properties, function ($property) use ($meta) {
            $columnName = $meta->getColumnName($property);
            return $meta->isAssociationWithSingleJoinColumn($property) || in_array($columnName, $meta->getColumnNames()) || $property === 'id';
        });

        // use reflection properties to get the complete array of columns
        $tableColumns = array_map(function ($property) use ($meta) {
            return $meta->isAssociationWithSingleJoinColumn($property) ? $meta->getSingleAssociationJoinColumnName($property) : $meta->getColumnName($property);
        }, $properties);

        // use properties again to define the query parameter
        $valuesDefinition = array_map(function ($property) {
            return ':' . $property;
        }, $properties);

        //I need to remove the ID column from the update stmt eventually
        $updateStmt = array_map(function ($v, $k) {
            return sprintf("%s=%s", $k, $v);
        }, array_diff($valuesDefinition, [':id']), array_diff($tableColumns, ['id']));

        return sprintf($insertTemplate, $tableName, implode(', ', $tableColumns), implode(', ', $valuesDefinition), implode(', ', $updateStmt));
    }
}
