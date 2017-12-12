# Situation

Table Article (ID, title, content)
Table Commentaire (ID, content)

1 Article <-possède-> 0/1/* Commentaire(s)

-> Many to One (Plusieurs Commentaires vont vers 1 seul Article)
-> One to Many (1 Article va vers plusieurs Commentaires)

# Idée

Utiliser Doctrine au lieu de faire des requêtes manuelles

# Mise en place

## Classes

```php
use Doctrine\Common\Collections\ArrayCollection;

/** @Entity */
class Product
{
    // ...
    /**
     * One Product has Many Features.
     * @OneToMany(targetEntity="Feature", mappedBy="product")
     */
    private $features;
    // ...

    public function __construct() {
        $this->features = new ArrayCollection();
    }
}

/** @Entity */
class Feature
{
    // ...
    /**
     * Many Features have One Product.
     * @ManyToOne(targetEntity="Product", inversedBy="features")
     * @JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;
    // ...
}
```

## Fichiers YAML

Product:
  type: entity
  oneToMany:
    features:
      targetEntity: Feature
      mappedBy: product
      
Feature:
  type: entity
  manyToOne:
    product:
      targetEntity: Product
      inversedBy: features
      joinColumn:
        name: product_id
        referencedColumnName: id

# Ressources

http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/association-mapping.html