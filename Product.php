<?php
class Product {

    // Attributes 
    private $id;
    private $name;
    private $category;
    private $description;
    private $price;
    private $quantity;
    private $rating;
    private $image;

    
    // Constructor
    public function __construct($id, $name, $category, $description, $price, $quantity, $rating, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->description = $description;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->rating = $rating;
        $this->image = $image;
    }



    // Getters and Setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function getRating() {
        return $this->rating;
    }

    public function setRating($rating) {
        $this->rating = $rating;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }


    // Methods
    public function displayInTable() {
        return "<tr>
                    <td><img src='images/{$this->image}' alt='{$this->name}' width='50'></td>
                    <td><a href='view.php?id={$this->id}'>{$this->id}</a></td>
                    <td>{$this->name}</td>
                    <td>{$this->category}</td>
                    <td>{$this->price}</td>
                    <td>{$this->quantity}</td>
                    <td>
                        <a href=\"edit.php?id=" . htmlspecialchars($this->id) . "\">
                            <image src=\"images/edit.png\" alt=\"Edit\" width=\"20\">
                        </a>
                        <a href=\"delete.php?id=" . htmlspecialchars($this->id) . "\">
                            <image src=\"images/delete.png\" alt=\"Delete\" width=\"20\">
                        </a>
                    </td>
                </tr>";
    }

    public function displayProductPage() {
        return "<main>
                    <img src='images/{$this->image}' alt='{$this->name}' width=\"300px\">
                    <h1>Product ID: {$this->id}, {$this->name}</h1>
                    <ul>
                        <li>Price: \${$this->price}</li>
                        <li>Category: {$this->category}</li>
                        <li>Rating: {$this->rating}</li>
                    </ul>
                    <h2>Description:</h2>
                    <p>{$this->description}</p>
                </main>";
    }


}
?>
