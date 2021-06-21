<?php
class Ville
{

	private $idVille;
    private $nomVille;
	private $cp;
    private $departement;
    private $region;
    
	/* Constructeur */
	public function __construct(int $idVille, string $cp, string $nomVille, string $departement, string $region)
	{
		$this->idVille = $idVille;
        $this->cp = $cp;
		$this->nomVille = $nomVille;
        $this->departement = $departement;
        $this->region = $region;
	}

	/* Getters/Setters */
	public function getIdVille(): int
	{
		return $this->idVille;
	}

	public function setIdVille(int $idVille)
	{
		$this->idVille = $idVille;
	}

	public function getNomVille(): string
	{
		return $this->nomVille;
	}

	public function setnomVille(string $nomVille)
	{
		$this->nomVille = $nomVille;
	}

	public function getCp(): string
	{
		return $this->cp;
	}

	public function setCp(string $cp)
	{
		$this->cp = $cp;
	}

    public function getDepartement(): string
	{
		return $this->departement;
	}

	public function setDepartement(string $departement)
	{
		$this->departement = $departement;
	}

	public function getRegion(): string
	{
		return $this->region;
	}

	public function setRegion(string $region)
	{
		$this->region = $region;
	}
}