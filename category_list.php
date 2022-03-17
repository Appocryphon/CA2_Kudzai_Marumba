<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" type="text/css" href="opener.css">

<style>
   

input[type=submit] {
  width: 100%;
  background-color: green;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=file]
{
    cursor: pointer;
}

h1
{
text-align: center;
}


    
</style>

</head>



<?php
    require_once('database.php');

    // Get all categories
    $query = 'SELECT * FROM categories
              ORDER BY categoryID';
    $statement = $db->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll();
    $statement->closeCursor();
?>
<!-- the head section -->
<div class="container">
<?php
include('includes/header.php');
?>
    <h1>Category List</h1>

        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($categories as $category) : ?>
        <tr>
            <td><?php echo $category['categoryName']; ?></td>
            <td>
                <form action="delete_category.php" method="post"
                      id="delete_product_form">
                    <input type="hidden" name="category_id"
                           value="<?php echo $category['categoryID']; ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    
    <br>

    <h2>Add Category</h2>
    <form action="add_category.php" method="post"
          id="add_category_form">

        <label>Name:</label>
        <input type="input" name="name">
        <input id="add_category_button" type="submit" value="Add">
    </form>
    <br>
    <p><a href="opener.php">Homepage</a></p>

    <?php
include('includes/footer.php');
?>

<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
<ul class="navbar-nav">
<li class="nav-item">
      <a class="nav-link" href="opener.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href=".?category_id=1">Manga</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href=".?category_id=2">Anime</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href=".?category_id=3">Merch</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="add_record_form.php">Add Record</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="category_list.php">Manage Categories</a>
    </li>

  </ul>


</body>