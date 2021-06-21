<?php
class Location
{

	private $idLocation;
	private $dateLocation;
	private $finLocation;
	private $fkIdInstruLoc;
	private $fkIdForfait;
	private $fkIdClient;
	private $instrument_Location;
	private $forfait;
	private $client;


	/* Constructeur */
	public function __construct(int $idLocation, string $dateLocation, string $finLocation, int $fkIdForfait, int $fkIdInstruLoc, int $fkIdClient)
	{
		$this->idLocation = $idLocation;
		$this->dateLocation = $dateLocation;
		$this->finLocation = $finLocation;
		$this->fkIdForfait = $fkIdForfait;
		$this->fkIdInstruLoc = $fkIdInstruLoc;
		$this->fkIdClient = $fkIdClient;
		$this->instrument_Location = Instrument_LocationRepo::getInstrument_Location($fkIdInstruLoc);
		$this->forfait = ForfaitRepo::getForfait($fkIdForfait);
		$this->client = ClientRepo::getClient($fkIdClient);
	}

	/* Getters/Setters */
	public function getIdLocation(): int
	{
		return $this->idLocation;
	}

	public function setIdLocation(int $idLocation)
	{
		$this->idLocation = $idLocation;
	}


	public function getDateLocation(): string
	{
		return $this->dateLocation;
	}

	public function getDateLocationISO(): string
	{
		return date("Y-m-d", $this->dateLocation);
	}

	public function setDateLocation(string $dateLocation)
	{
		$this->dateLocation = $dateLocation;
	}

	public function getFinLocation(): string
	{
		return $this->finLocation;
	}

	public function getFinLocationISO(): string
	{
		return date("Y-m-d", $this->dateLocation);
	}

	public function setFinLocation(string $finLocation)
	{
		$this->finLocation = $finLocation;
	}

	public function getFkIdInstruLoc(): int
	{
		return $this->fkIdInstruLoc;
	}

	public function setFkIdInstruLoc(int $fkIdInstruLoc)
	{
		$this->fkIdInstruLoc = $fkIdInstruLoc;
	}

	public function getFkIdForfait(): int
	{
		return $this->fkIdForfait;
	}

	public function setFkIdForfait(int $fkIdForfait)
	{
		$this->fkIdForfait = $fkIdForfait;
	}

	public function getFkIdClient(): int
	{
		return $this->fkIdClient;
	}

	public function setFkIdClient(int $fkIdClient)
	{
		$this->fkIdClient = $fkIdClient;
	}


	public function getClient(): Client
	{
		return $this->client;
	}

	public function setClient(Client $newClient)
	{
		$this->Client = $newClient;
	}

	public function getInstrument_Location(): Instrument_Location
	{
		return $this->instrument_Location;
	}

	public function setInstrument_Location(Instrument_Location $newInstrument_Location)
	{
		$this->instrument_Location = $newInstrument_Location;
	}

	public function getForfait(): Forfait
	{
		return $this->forfait;
	}

	public function setForfait(Forfait $newForfait)
	{
		$this->forfait = $newForfait;
	}

}
