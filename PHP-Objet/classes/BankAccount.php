<?php


class BankAccount
{
    /** @var string */
    protected $proprietaire;

    /** @var double */
    protected $solde;

    /**
     * @return string
     */
    public function getProprietaire(): string
    {
        return $this->proprietaire;
    }

    /**
     * @param string $proprietaire
     * @return BankAccount
     */
    public function setProprietaire(string $proprietaire): BankAccount
    {
        $this->proprietaire = $proprietaire;
        return $this;
    }

    /**
     * @return float
     */
    public function getSolde(): float
    {
        return $this->solde;
    }

    /**
     * @param float $solde
     * @return BankAccount
     */
    public function setSolde(float $solde): BankAccount
    {
        $this->solde = $solde;
        return $this;
    }

    /**
     * @param float $montant
     * @return $this
     * @throws Exception
     */
    public function crediter(float $montant): BankAccount
    {
        if ($montant < 0) {
            throw new Exception('Le montant ne peut être négatif');
        }

        $this->solde += $montant;
        return $this;
    }

    /**
     * @param float $montant
     * @return $this
     * @throws Exception
     */
    public function debiter(float $montant): BankAccount
    {
        if ($montant < 0) {
            throw new Exception('Le montant ne peut être négatif');
        }

        $this->solde -= $montant;
        return $this;
    }
}