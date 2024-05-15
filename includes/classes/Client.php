<?php
class Client
{

	private $idClient;
	private $nom;
	private $prenom;
    private $adresse;
    private $telephone;
	private $email;
	private $password;
	private $profilAdmin;
	private $estValide;
	private $jetonValidation;
	private $fkIdVille;
	private $ville;
	private $status;

	/* Constructeur */
	public function __construct(int $idClient, string $nom, string $prenom, string $adresse, string $telephone, string $email, string $password, string $profilAdmin, string $estValide, string $jetonValidation, int $fkIdVille)
	{
		$this->idClient = $idClient;
		$this->nom = $nom;
		$this->prenom = $prenom;
        $this->adresse = $adresse;
		$this->telephone = $telephone;
        $this->email = $email;
		$this->password = $password;
		$this->profilAdmin = $profilAdmin;
		$this->estValide = $estValide;
		$this->jetonValidation = $jetonValidation;
		$this->fkIdVille = $fkIdVille;
		$this->ville = VilleRepo::getVille($fkIdVille);
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

	public function getStatus(): string
	{
		if($this->profilAdmin == 1) {
			$this->status = 'Oui';
		}else {
			$this->status = 'Non';
		}
		return $this->status;
	}

	public function getProfilAdmin(): bool
	{
		
		return $this->profilAdmin;
	}

	public function setProfilAdmin(bool $profilAdmin)
	{
		$this->profilAdmin = $profilAdmin;
	}

	public function getValidationStatus(): string
	{
		if($this->estValide == 1) {
			$this->status = 'Oui';
		}else {
			$this->status = 'En cours';
		}
		return $this->status;
	}

	public function getEstValide(): bool
	{
		return $this->estValide;
	}

	public function setEstValide(bool $estValide)
	{
		$this->estValide = $estValide;
	}

	public function getJetonValidation(): string
	{
		return $this->jetonValidation;
	}

	public function setJetonValidation(string $jetonValidation)
	{
		$this->jetonValidation = $jetonValidation;
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

}
