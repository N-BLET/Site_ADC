<?php
class Instrument_Location
{

	private $idInstruLoc;
    private $typeInstruLoc;
	private $marqueInstruLoc;
	private $modeleInstruLoc;
    private $numeroSerieInstruLoc;
	private $dateAchatInstruLoc;
	private $statutLocation;
	// private $location;
	// private $status;

	/* Constructeur */
	public function __construct(int $idInstruLoc, string $typeInstruLoc, string $marqueInstruLoc, string $modeleInstruLoc, string $numeroSerieInstruLoc, string $dateAchatInstruLoc, bool $statutLocation)
	{
		$this->idInstruLoc = $idInstruLoc;
        $this->typeInstruLoc = $typeInstruLoc;
		$this->marqueInstruLoc = $marqueInstruLoc;
		$this->modeleInstruLoc = $modeleInstruLoc;
        $this->numeroSerieInstruLoc = $numeroSerieInstruLoc;
		$this->dateAchatInstruLoc = strtotime($dateAchatInstruLoc);
		$this->statutLocation = $statutLocation;
	}

	/* Getters/Setters */
	public function getIdInstrument(): int
	{
		return $this->idInstruLoc;
	}

	public function setIdInstrument(int $idInstruLoc)
	{
		$this->idInstruLoc = $idInstruLoc;
	}

    public function getTypeInstrument(): string
	{
		return $this->typeInstruLoc;
	}

	public function setTypeInstrument(string $typeInstruLoc)
	{
		$this->typeInstruLoc = $typeInstruLoc;
	}

	public function getMarque(): string
	{
		return $this->marqueInstruLoc;
	}

	public function setMarque(string $marqueInstruLoc)
	{
		$this->marqueInstruLoc = $marqueInstruLoc;
	}

	public function getModele(): string
	{
		return $this->modeleInstruLoc;
	}

	public function setModele(string $modeleInstruLoc)
	{
		$this->modeleInstruLoc = $modeleInstruLoc;
	}

    public function getNumeroSerie(): string
	{
		return $this->numeroSerieInstruLoc;
	}

	public function setNumeroSerie(string $numeroSerieInstruLoc)
	{
		$this->numeroSerieInstruLoc = $numeroSerieInstruLoc;
	}

    public function getDateAchatTab(): string
	{
		return date("d/m/Y",$this->dateAchatInstruLoc);
	}

	public function getDateAchatForm(): string
	{
		return date("Y-m-d", $this->dateAchatInstruLoc);
	}

	public function setDateAchat(string $dateAchatInstruLoc)
	{
		$this->dateAchatInstruLoc = $dateAchatInstruLoc;
	}

	public function isStatutLocation(): string
	{
		return ($this->statutLocation) ? "oui" : "non";
	}

	public function setStatutLocation(bool $isRent)
	{
		$this->statutLocation = $isRent;
	}


}