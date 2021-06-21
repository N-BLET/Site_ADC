<?php
class Instrument
{

	private $idInstrument;
    private $typeInstrument;
	private $marque;
	private $modele;
    private $numeroSerie;
	private $dateAchat;
	private $client;

	/* Constructeur */
	public function __construct(int $idInstrument, string $typeInstrument, string $marque, string $modele, string $numeroSerie, string $dateAchat, int $fkIdClient)
	{
		$this->idInstrument = $idInstrument;
        $this->typeInstrument = $typeInstrument;
		$this->marque = $marque;
		$this->modele = $modele;
        $this->numeroSerie = $numeroSerie;
		$this->dateAchat = strtotime($dateAchat);
		$this->client = ClientRepo::getClient($fkIdClient);
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

    public function getDateAchat(): int
	{
		return $this->dateAchat;
	}

	public function getDateAchatStr(): string
	{
		return date("d/m/Y", $this->dateAchat);
	}

    public function getDateAchatISO(): string
	{
		return date("Y-m-d", $this->dateAchat);
	}

	public function setDateAchat(string $dateAchat)
	{
		$this->dateAchat = $dateAchat;
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
		$this->client = $newClient;
	}
	
}