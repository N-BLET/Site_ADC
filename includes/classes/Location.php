<?php
class Location
{

	private $idLocation;
	private $dateLocation;
	private $finLocation;
	private $fkIdForfait;
	private $fkIdClient;
	private $fkIdInstrument;
	private $forfait;
	private $client;
	private $instrument;


	/* Constructeur */
	public function __construct(int $idLocation, string $dateLocation, string $finLocation, int $fkIdForfait, int $fkIdClient, int $fkIdInstrument)
	{
		$this->idLocation = $idLocation;
		$this->dateLocation = strtotime($dateLocation);
		$this->finLocation = strtotime($finLocation);
		$this->fkIdForfait = $fkIdForfait;
		$this->fkIdInstrument = $fkIdInstrument;
		$this->fkIdClient = $fkIdClient;
		$this->forfait = ForfaitRepo::getForfait($fkIdForfait);
		$this->client = ClientRepo::getClient($fkIdClient);
		$this->instrument = InstrumentRepo::getInstrument($fkIdInstrument);
		//Instrument_LocationRepo::getInstrument_Location($fkIdInstruLoc)->setStatutLocation(true);
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

	public function getDateLocationTab(): string
	{
		return date("d/m/Y",$this->dateLocation);
	}

	public function getDateLocationForm(): string
	{
		return date("Y-m-d", $this->dateLocation);
	}

	public function setDateLocation(string $dateLocation)
	{
		$this->dateLocation = $dateLocation;
	}

	public function getFinLocation(): string
	{
		return $this->dateLocation;
	}

	public function getFinLocationTab(): string
	{
		return date("d/m/Y", $this->finLocation);
	}

	public function getFinLocationForm(): string
	{
		return date("Y-m-d", $this->finLocation);
	}

	public function setFinLocation(string $finLocation)
	{
		$this->finLocation = $finLocation;
	}

	public function getFkIdInstrument(): int
	{
		return $this->fkIdInstrument;
	}

	public function setFkIdInstrument(int $fkIdInstrument)
	{
		$this->fkIdInstrument = $fkIdInstrument;
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

	public function getClient(): ?Client
	{
		return $this->client;
	}

	public function setClient(Client $newClient)
	{
		$this->client = $newClient;
	}
		public function getForfait(): ?Forfait
	{
		return $this->forfait;
	}

	public function setForfait(Forfait $newForfait)
	{
		$this->forfait = $newForfait;
	}

	public function getInstrument(): Instrument
	{
		return $this->instrument;
	}

	public function setInstrument(Instrument $newInstrument)
	{
		$this->forfait = $newInstrument;
	}

}
