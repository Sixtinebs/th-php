<?php

namespace entities;

class Structure
{
    private int $id ;
    private string $nom;
    private string $rue;
    private string $cp;
    private string $ville;
    private int $estasso;
    private ?int $nb_donateurs = null;
    private ?int $nb_actionnaires = null;

    public function __construct(int  $id, string $nom, string $rue, string $cp, string $ville, int $estasso = 0,  $nb_donateurs = null, $nb_actionnaires = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->rue = $rue;
        $this->cp = $cp;
        $this->ville = $ville;
        $this->estasso = $estasso;
        $this->nb_donateurs = $nb_donateurs;
        $this->nb_actionnaires = $nb_actionnaires;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * @param mixed $rue
     */
    public function setRue($rue): void
    {
        $this->rue = $rue;
    }

    /**
     * @return mixed
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param mixed $cp
     */
    public function setCp($cp): void
    {
        $this->cp = $cp;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville): void
    {
        $this->ville = $ville;
    }

    /**
     * @return mixed
     */
    public function getEstasso()
    {
        return $this->estasso;
    }

    /**
     * @param mixed $estasso
     */
    public function setEstasso($estasso): void
    {
        $this->estasso = $estasso;
    }

    /**
     * @return mixed
     */
    public function getNbDonateurs()
    {
        return $this->nb_donateurs;
    }

    /**
     * @param mixed $nb_donateurs
     */
    public function setNbDonateurs($nb_donateurs): void
    {
        $this->nb_donateurs = $nb_donateurs;
    }

    /**
     * @return mixed
     */
    public function getNbActionnaires()
    {
        return $this->nb_actionnaires;
    }

    /**
     * @param mixed $nb_actionnaires
     */
    public function setNbActionnaires($nb_actionnaires): void
    {
        $this->nb_actionnaires = $nb_actionnaires;
    }




}