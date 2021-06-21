<?php

class Animal
{
    public $regNumber;
    public $product;

    public function getProduct()
    {
        return $this->product;
    }
}

class Cow extends Animal
{
    public $type = 'Cow';
    public $product = 'Milk';

    public function getProduct()
    {
        return rand(8,12);
    }
}

class Chicken extends Animal
{
    public $type = 'Chicken';
    public $product = 'Egg';

    public function getProduct()
    {
        return rand(0,1);
    }
}

class Farm
{
    private $idLastAnimal = 1;
    private $animals = [];
    private $products = [];

    public function addAnimal(Animal $animal)
    {
        $animal->regNumber = $this->idLastAnimal++;
        $this->animals[$animal->type][] = $animal;
    }

    public function getCountAnimals()
    {
        $countAnimals = [];
        foreach($this->animals as $type => $animal) {
            $countAnimals[$type] = count($animal);
        }
        return $countAnimals;
    }

    public function getProducts()
    {
        foreach($this->animals as $type) {
            foreach($type as $animal) {
                $this->products[$animal->product] += $animal->getProduct();
            }
        }

        return;
    }

    public function getCollectedProducts()
    {
        return $this->products;
    }

    public function clearStorage()
    {
        $this->products = [];
        return;
    }
}



$farm = new Farm();

//Система должна добавить животных в хлев (10 коров и 20 кур).
for($i=0; $i<10; $i++) {
    $cow = new Cow();
    $farm->addAnimal($cow);
}
for($i=0; $i<20; $i++) {
    $chicken = new Chicken();
    $farm->addAnimal($chicken);
}

//Вывести на экран информацию о количестве каждого типа животных на ферме.
$allAnimals = $farm->getCountAnimals();
var_dump($allAnimals);

//7 раз (неделю) произвести сбор продукции (подоить коров и собрать яйца у кур).
for( $i=0; $i < 7; $i++ ) {
    $farm->getProducts();
}

//Вывести на экран общее кол-во собранных за неделю шт. яиц и литров молока.
$collectedProduct = $farm->getCollectedProducts();
var_dump($collectedProduct);

//Добавить на ферму ещё 5 кур и 1 корову (съездили на рынок, купили животных).
$cow = new Cow();
$farm->addAnimal($cow);

for($i=0; $i<5; $i++) {
    $chicken = new Chicken();
    $farm->addAnimal($chicken);
}

//Снова вывести информацию о количестве каждого типа животных на ферме.
$allAnimals = $farm->getCountAnimals();
var_dump($allAnimals);

//Снова 7 раз (неделю) производим сбор продукции и выводим результат на экран.
//Очищаем склад
$farm->clearStorage();

for( $i=0; $i < 7; $i++ ) {
    $farm->getProducts();
}

$collectedProduct = $farm->getCollectedProducts();
var_dump($collectedProduct);

?>