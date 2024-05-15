<?php
class Instrument
{

	private $idInstrument;
    private $typeInstrument;
	private $marque;
	private $modele;
    private $numeroSerie;
	private $dateAchat;
	private $parcLocation;
	private $client;
	private $location;
	private $fkIdClient;
	private $fkIdLocation;
	private $statutLocation;

	/* Constructeur */
	public function __construct(int $idInstrument, string $typeInstrument, string $marque, string $modele, string $numeroSerie, string $dateAchat, bool $parcLocation, ?int $fkIdClient, ?int $fkIdLocation)
	{
		$this->idInstrument = $idInstrument;
        $this->typeInstrument = $typeInstrument;
		$this->marque = $marque;
		$this->modele = $modele;
        $this->numeroSerie = $numeroSerie;
		$this->dateAchat = strtotime($dateAchat);
		$this->parcLocation = $parcLocation;
		$this->client = is_null($fkIdClient) ? null : ClientRepo::getClient($fkIdClient);
		//$this->location = is_null($fkIdLocation) ? null : LocationRepo::getLocation($fkIdLocation);
		// if($fkIdClient != null){
		// 	$this->location = LocationRepo::getLocationSelonClient($fkIdClient);
		// }
		if($fkIdClient != null && $parcLocation){
			$this->statutLocation = true;
		}
	}

	/* Getters/Setters */
	public function getIdInstrument(): int
	{
		return $this->idInstrument;
	}

	public function setIdInstrument(int $idInstrument)
	{
		$this->idInstrument = $idInstrument;
	}

    public function getTypeInstrument(): string
	{
		return $this->typeInstrument;
	}

	public function setTypeInstrument(string $typeInstrument)
	{
		$this->typeInstrument = $typeInstrument;
	}

	public function getMarque(): string
	{
		return $this->marque;
	}

	public function setMarque(string $marque)
	{
		$this->marque = $marque;
	}

	public function getModele(): string
	{
		return $this->modele;
	}

	public function setModele(string $modele)
	{
		$this->modele = $modele;
	}

    public function getNumeroSerie(): string
	{
		return $this->numeroSerie;
	}

	public function setNumeroSerie(string $numeroSerie)
	{
		$this->numeroSerie = $numeroSerie;
	}

    public function getDateAchat(): string
	{
		return $this->dateAchat;
	}

	public function getDateAchatTab(): string
	{
		return date("d/m/Y", $this->dateAchat);
	}

	public function getDateAchatForm(): string
	{
		return date("Y-m-d", $this->dateAchat);
	}

	public function setDateAchat(string $dateAchat)
	{
		$this->dateAchat = $dateAchat;
	}

	public function getFkIdClient(): ?int
	{
		return $this->fkIdClient;
	}

	public function setFkIdClient(?int $fkIdClient)
	{
		$this->fkIdClient = $fkIdClient;
	}

	public function getClient(): ?Client
	{
		return $this->client;
	}

	public function setClient(Client $newClient)
	{
		$this->client = $newClient;
	}

	public function isParcLocation(): bool
	{
		return $this->parcLocation;
	}

	public function setParcLocation(bool $parcLocation)
	{
		$this->parcLocation = $parcLocation;
	}

	public function getLocation(): ?Location
	{
		return $this->location;
	}

	public function setLocation(Location $newLocation)
	{
		$this->parcLocation = $newLocation;
	}

	public function getFkIdLocation(): int
	{
		return $this->fkIdLocation;
	}

	public function setFkIdLocation(int $fkIdLocation)
	{
		$this->fkIdLocation = $fkIdLocation;
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