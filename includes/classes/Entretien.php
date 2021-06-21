<?php
class Entretien
{

	private $idEntretien;
	private $dateEntretien;
	private $descriptionEntretien;
	private $prixEntretien;
	private $instrument;


	/* Constructeur */
	public function __construct(int $idEntretien, string $dateEntretien, string $descriptionEntretien, float $prixEntretien, int $fkIdInstrument)
	{
		$this->idEntretien = $idEntretien;
		$this->dateEntretien = strtotime($dateEntretien);
		$this->descriptionEntretien = $descriptionEntretien;
		$this->prixEntretien = $prixEntretien;
		$this->fkIdInstrument = $fkIdInstrument;
		$this->instrument = InstrumentRepo::getInstrument($fkIdInstrument);
	}

	/* Getters/Setters */
	public function getIdEntretien(): int
	{
		return $this->idEntretien;
	}

	public function setIdEntretien(int $idEntretien)
	{
		$this->idEntretien = $idEntretien;
	}

	public function getDateEntretien(): string
	{
		return $this->dateEntretien;
	}

	public function getDateEntretienISO(): string
	{
		return date("Y-m-d", $this->dateEntretien);
	}

	public function getDateEntretienStr(): string
	{
		return date("d/m/Y", $this->dateEntretien);
	}

	public function setDateEntretien(string $dateEntretien)
	{
		$this->dateEntretien = $dateEntretien;
	}


	public function getDescriptionEntretien(): string
	{
		return $this->descriptionEntretien;
	}

	public function setDescriptionEntretien(string $descriptionEntretien)
	{
		$this->descriptionEntretien = $descriptionEntretien;
	}

	public function getPrixEntretien(): float
	{
		return $this->prixEntretien;
	}

	public function setPrixEntretien(float $prixEntretien)
	{
		$this->prixEntretien = $prixEntretien;
	}

	public function getFkIdInstrument(): int
	{
		return $this->fkIdInstrument;
	}

	public function setFkIdInstrument(int $fkIdInstrument)
	{
		$this->fkIdEntretien = $fkIdInstrument;
	}

	public function getInstrument(): Instrument
	{
		return $this->instrument;
	}

	public function setInstrument(Instrument $newInstrument)
	{
		$this->instrument = $newInstrument;
	}	

}
