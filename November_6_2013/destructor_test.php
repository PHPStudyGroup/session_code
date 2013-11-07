<?php
class Bar
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;

        echo 'Created a new Bar: ', $this->name, "\n";
    }

    public function __destruct()
    {
        echo "Burned {$this->name} to the ground.", "\n";
    }
}

$coyote = new Bar('Coyote Ugly');
$coyoteFranchise = $coyote;
$coyoteFranchise2  = $coyote;
//$coyoteFranchise2 = clone $coyote;
$cheers = new Bar('Cheers');
new Bar("Paddy's");
echo "About to unset coyote\n";
unset($coyoteFranchise2);
unset($coyoteFranchise);
echo "After unset\n";
echo 'Burn it down' , "\n";
unset($coyote);
