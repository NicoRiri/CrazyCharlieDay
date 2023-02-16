<?php

namespace ccd\Element;

class Panier
{

    private array $produits;

    public function __construct(string $user)
    {
        $this->produits = array();
        $this->initialize($user);
    }

    public function __get(string $at): mixed
    {
        if (property_exists($this, $at)) return $this->$at;
        else throw new \Exception("$at: invalid property");
    }

    public function addProduit(Produit $produit): void
    {
        $this->produits[] = $produit;
    }

    private function initialize($user): void
    {
        $sql = "select * from panier2user where user=?";
        $res = \ccd\db\ConnectionFactory::$db->prepare($sql);
        $res->bindParam(1, $user);
        $res->execute();
        $c = new Catalogue();
        while ($row = $res->fetch(\PDO::FETCH_ASSOC)) {
            $id = (int) $row['id'];
            foreach ($c->produits as $key => $value) {
                if ($value->id === $id) {
                    $this->produits[] = $value;
                    break;
                }
            }
        }
    }
}
