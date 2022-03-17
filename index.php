<?php
require_once('database.php');

// Get category ID
if (!isset($category_id)) {
$category_id = filter_input(INPUT_GET, 'category_id', 
FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
$category_id = 1;
}
}

// Get name for current category
$queryCategory = "SELECT * FROM categories
WHERE categoryID = :category_id";
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$statement1->closeCursor();
$category_name = $category['categoryName'];

// Get all categories
$queryAllCategories = 'SELECT * FROM categories
ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get records for selected category
$queryRecords = "SELECT * FROM records
WHERE categoryID = :category_id
ORDER BY recordID";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$records = $statement3->fetchAll();
$statement3->closeCursor();
?>

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
</head>

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

  <form class="form-inline" action="/action_page.php">
    <input class="form-control mr-sm-2" type="text" placeholder="Search...">
    <button class="btn btn-success" type="submit">Search</button>
  </form>
</nav>
</body>





<style>
    body
    {
        background-image: url('https://www.tomboweurope.com/fileadmin/_processed_/a/c/csm_Manga_sketch5_aff0e0d6df.jpg');
        background-repeat: no-repeat;
        background-size: cover;
    }

table {
    border: 1px;
    border-collapse: collapse;
}
td, th {
    border: 1px;
    padding: .2em .5em .2em .5em;
    vertical-align: center;
    text-align: center;
}
form {
    margin: 0;
}
footer {
    clear: both;
    margin-top: 1em;
    border-top: 2px solid black;
}
footer p {
    text-align: right;
    font-size: 80%;
    margin: 1em 0;
}

nav form
{
    padding-left: 950px;
}
section
{
    margin-right: 200px;
}
table th, td
{
    padding-left: 150px;
    color: purple;
}

h2
{
    text-align: center;
    padding-bottom: 50px;   
}

    
</style>


<body>
<section>
<!-- display a table of records -->
<h2><?php echo $category_name; ?></h2>
<table>
<tr>
<th>Image</th>
<th>Name</th>
<th>Price</th>
<th>Delete</th>
<th>Edit</th>
</tr>
<?php foreach ($records as $record) : ?>
<tr>
<td><img src="image_uploads/<?php echo $record['image']; ?>" width="250px" height="300px" /></td>
<td><?php echo $record['name']; ?></td>
<td class="right"><?php echo $record['price']; ?></td>
<td><form action="delete_record.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $record['categoryID']; ?>">
<input type="submit" value="Delete">
</form></td>
<td><form action="edit_record_form.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $record['categoryID']; ?>">
<input type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
</section>
<?php
include('includes/footer.php');
?>

</body>