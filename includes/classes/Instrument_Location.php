<?php
class Instrument_Location
{

	private $idInstruLoc;
    private $typeInstruLoc;
	private $marqueInstruLoc;
	private $modeleInstruLoc;
    private $numeroSerieInstruLoc;
	private $dateAchatInstruLoc;
	private $location;

	/* Constructeur */
	public function __construct(int $idInstruLoc, string $typeInstruLoc, string $marqueInstruLoc, string $modeleInstruLoc, string $numeroSerieInstruLoc, string $dateAchatInstruLoc)
	{
		$this->idInstruLoc = $idInstruLoc;
        $this->typeInstruLoc = $typeInstruLoc;
		$this->marqueInstruLoc = $marqueInstruLoc;
		$this->modeleInstruLoc = $modeleInstruLoc;
        $this->numeroSerieInstruLoc = $numeroSerieInstruLoc;
		$this->dateAchatInstruLoc = strtotime($dateAchatInstruLoc);
		$this->location = LocationRepo::getLocation($idInstruLoc);
	}

	/* Getters/Setters */
	public function getIdInstrument(): int
	{
		return $this->idInstruLoc;
	}

	public function setIdInstrument(int $idInstruLoc)
	{
		$this->idInstruInstruLoc = $idInstruLoc;
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

    public function getDateAchat(): int
	{
		return $this->dateAchatInstruLoc;
	}

	public function getDateAchatStr(): string
	{
		return date("d/m/Y", $this->dateAchatInstruLoc);
	}

    public function getDateAchatISO(): string
	{
		return date("Y-m-d", $this->dateAchatInstruLoc);
	}

	public function setDateAchat(string $dateAchatInstruLoc)
	{
		$this->dateAchatInstruLoc = strtotime($dateAchatInstruLoc);
	}

	public function getLocation(): location
	{
		return $this->location;
	}

	public function setLocation(location $newLocation)
	{
		$this->location = $newLocation;
	}

	public function getStatus(): string
	{
		if($this->location) {
			$this->status = 'Oui';
		}else {
			$this->status = 'Non';
		}
		return $this->status;
	}


}