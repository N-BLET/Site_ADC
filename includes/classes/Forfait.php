<?php
class Forfait
{

	private $idForfait;
	private $duree;
	private $tarif;

	/* Constructeur */
	public function __construct(int $idForfait, string $duree, float $tarif)
	{
		$this->idForfait = $idForfait;
		$this->duree = $duree;
		$this->tarif = $tarif;
	}

	/* Getters/Setters */
	public function getIdForfait(): int
	{
		return $this->idForfait;
	}

	public function setIdForfait(int $idForfait)
	{
		$this->idForfait = $idForfait;
	}

	public function getDuree(): string
	{
		return $this->duree;
	}

	public function setDuree(string $duree)
	{
		$this->duree = $duree;
	}

    public function getTarif(): float
	{
		return $this->tarif;
	}

	public function setTarif(float $tarif)
	{
		$this->tarif = $tarif;
	}

}