<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\PrimaryAttribute;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class ExportController extends AbstractController
{
    /**
     * @Route("/export", name="export")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $characters = $entityManager->getRepository(Character::class)->findBy([], null, 1000);
        $request->query->has('optimize') && $this->optimize($characters, $entityManager);
        return $this->json($characters, Response::HTTP_OK, [], ['groups' => ['view']]);
    }

    /**
     * @param Character[] $characters
     */
    private function optimize(array $characters, EntityManagerInterface $entityManager)
    {
        // optimize direct ManyToOne relation
        $meta = $entityManager->getClassMetadata(Character::class);
        foreach ($meta->getAssociationMappings() as $property => $mapping) {
            /** @var QueryBuilder $qb */
            $qb = $entityManager->getRepository($mapping['targetEntity'])->createQueryBuilder('a');

            if ($mapping['type'] === ClassMetadataInfo::MANY_TO_ONE) {
                $reflectedProperty = $meta->getReflectionProperty($property);
                $reflectedProperty->setAccessible(true);
                $ids = array_map(function (Character $character) use ($reflectedProperty) {
                    $lazyObj = $reflectedProperty->getValue($character);
                    if (null !== $lazyObj) {
                        return $lazyObj->getId();
                    }
                }, $characters);
                $qb
                    ->andWhere($qb->expr()->in('a', ':ids'))
                    ->setParameter('ids', array_unique($ids))
                    ->getQuery()->execute();
            }
        }
    }

    /**
     * @Route("/dump.csv", name="dump_csv")
     */
    public function dumpCSV(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $qb = $entityManager->getRepository(Character::class)->createQueryBuilder('c')
            ->setMaxResults($request->query->get('limit', 10000))
            ->setFirstResult($request->query->get('offset', 0))
        ;

        if ($request->query->has('optimize')) {
            $qb
                ->select('c.id as id')
                ->addSelect('IDENTITY(c.ancestry) as ancestry')
                ->addSelect('IDENTITY(c.ancestralTrait) as ancestralTrait')
                ->addSelect('c.sex as sex')
                ->addSelect('IDENTITY(c.profession) as profession')
                ->addSelect('IDENTITY(c.buildType) as buildType')
                ->addSelect('IDENTITY(c.complexion) as complexion')
                ->addSelect('IDENTITY(c.eyeColor) as eyeColor')
                ->addSelect('IDENTITY(c.hairColor) as hairColor')
                ->addSelect('IDENTITY(c.height) as height')
                ->addSelect('IDENTITY(c.weight) as weight')
                ->addSelect('IDENTITY(c.ageGroup) as ageGroup')
                ->addSelect('c.distinguishingMarks as distinguishingMarks')
                ->addSelect('IDENTITY(c.seasonOfBirth) as seasonOfBirth')
                ->addSelect('IDENTITY(c.dooming) as dooming')
                ->addSelect('IDENTITY(c.chaosAlignment) as chaosAlignment')
                ->addSelect('IDENTITY(c.orderAlignment) as orderAlignment')
                ->addSelect('IDENTITY(c.drawback) as drawback')
                ->addSelect('IDENTITY(c.socialClass) as socialClass')
                ->addSelect('IDENTITY(c.upbringing) as upbringing')
                ->addSelect('c.combat as combat')
                ->addSelect('c.brawn as brawn')
                ->addSelect('c.agility as agility')
                ->addSelect('c.perception as perception')
                ->addSelect('c.intelligence as intelligence')
                ->addSelect('c.willpower as willpower')
                ->addSelect('c.fellowship as fellowship')
                ->addSelect('c.trappings as trappings')
                ->addSelect('IDENTITY(c.armor) as armor')
                ->addSelect('c.name as name');
            $characters = $qb->getQuery()->getScalarResult();
        } else {
            $characters = array_map(function (Character $character) {
                return $character->dumpFactoryArguments();
            }, $qb->getQuery()->getResult());
        }

        return new StreamedResponse(function () use ($characters, $serializer) {
            foreach ($characters as $key => $character) {
                echo $serializer->serialize($character, 'csv', [CsvEncoder::NO_HEADERS_KEY => $key !== 0]);
                flush();
            }
        }, Response::HTTP_OK, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => HeaderUtils::makeDisposition(
                HeaderUtils::DISPOSITION_ATTACHMENT,
                'dump.csv'
            ),
        ]);
    }
}
