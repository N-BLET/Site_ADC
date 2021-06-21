<?php
class InfoClient
{

	private $idClient;
	private $nom;
	private $prenom;
    private $adresse;
    private $telephone;
	private $email;
	private $password;
	private $ville;
	private $instrument;
    private $entretien;
    private $location;

	/* Constructeur */
	public function __construct(int $idClient, string $nom, string $prenom, string $adresse, string $telephone, string $email, string $password, int $fkIdVille)
	{
		$this->idClient = $idClient;
		$this->nom = $nom;
		$this->prenom = $prenom;
        $this->adresse = $adresse;
		$this->telephone = $telephone;
        $this->email = $email;
		$this->password = $password;
		$this->fkIdVille = $fkIdVille;
		$this->ville = VilleRepo::getVille($fkIdVille);
		$this->instrument = InstrumentRepo::getInstrument($idInstrument);
		$this->entretien = EntretienRepo::getEntretien($idEntretien);
		$this->location = LocationRepo::getLocation($idLocation);
	}

	/* Getters/Setters */
	public function getIdClient(): int
	{
		return $this->idClient;
	}

	public function setIdClient(int $idClient)
	{
		$this->idClient = $idClient;
	}

	public function getNom(): string
	{
		return $this->nom;
	}

	public function setNom(string $nom)
	{
		$this->nom = $nom;
	}

	public function getPrenom(): string
	{
		return $this->prenom;
	}

	public function setPrenom(string $prenom)
	{
		$this->prenom = $prenom;
	}

    public function getAdresse(): string
	{
		return $this->adresse;
	}

	public function setAdresse(string $adresse)
	{
		$this->adresse = $adresse;
	}

    public function getTelephone(): string
	{
		return $this->telephone;
	}

	public function setTelephone(string $telephone)
	{
		$this->telephone = $telephone;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function setEmail(string $email)
	{
		$this->email = $email;
	}

	public function getPassword(): string
	{
		return $this->password;
	}

	public function setPassword(string $password)
	{
		$this->password = $password;
	}

	public function getVille(): Ville
	{
		return $this->ville;
	}

	public function setVille(Ville $newVille)
	{
		$this->ville = $newVille;
	}

	public function getFkIdVille(): int 
	{
		return $this->fkIdVille;
	}	

	public function setFkIdVille(int $fkIdVille)
	{
		$this->fkIdVille = $fkIdVille;
	}

	public function getInstrument(): Instrument
	{
		return $this->instrument;
	}

	public function setInstrument(Instrument $newInstrument)
	{
		$this->instrument = $newInstrument;
	}

	public function getEntretien(): Entretien
	{
		return $this->entretien;
	}

    public function setEntretien(Entretien $newEntretien)
	{
		$this->entretien = $newEntretien;
	}

	public function getLocation(): Location
	{
		return $this->location;
	}

	public function setLocation(Location $newLocation)
	{
		$this->location = $newLocation;
	}

}