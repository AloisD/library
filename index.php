<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "library_db";
$port = "3306";

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>

<h1>Library</h1>
<h2>Here are our books</h2>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

<table>
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Genre</th>
        <th>Publisher</th>
    </tr>

<?php

$query = "SELECT title, author.name as author, genre.name as genre, publisher.name as publisher FROM book JOIN author ON author = author.id JOIN genre ON genre = genre.id JOIN publisher ON publisher = publisher.id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {?>
        <tr>
            <td><?php echo $row ["title"]; ?></td>
            <td><?php echo $row ["author"]; ?></td>
            <td><?php echo $row ["genre"]; ?></td>
            <td><?php echo $row ["publisher"]; ?></td>
        </tr>

    <?php }}
?>
</table>

<h2>Add a new book</h2>

<form action="insert.php" method="post">
    <label>Title</label>
    <input type="text" name="title">
    <label>Author</label>
    <select name="author">
        <?php
        $authorQuery = "SELECT id, author.name as author FROM author";
        $authorResult = $conn->query($authorQuery);

        if ($authorResult->num_rows > 0) {
            while($row = $authorResult->fetch_assoc()) {?>
            <option value = "<?php echo $row ["id"]; ?>"><?php echo $row ["author"]; ?></option>
        <?php
            }}
        ?>
    </select>
    <label>Genre</label>
    <select name="genre">
        <?php
        $genreQuery = "SELECT id, genre.name as genre FROM genre";
        $genreResult = $conn->query($genreQuery);

        if ($genreResult->num_rows > 0) {
            while($row = $genreResult->fetch_assoc()) {?>
            
            <option value = "<?php echo $row ["id"]; ?>"><?php echo $row ["genre"]; ?></option>
        <?php
            }}
        ?>
    </select>
    <label>Publisher</label>
    <select name="publisher">
        <?php
        $publisherQuery = "SELECT id, publisher.name as publisher FROM publisher";
        $publisherResult = $conn->query($publisherQuery);

        if ($publisherResult->num_rows > 0) {
            while($row = $publisherResult->fetch_assoc()) {?>
            <option value = "<?php echo $row ["id"]; ?>"><?php echo $row ["publisher"]; ?></option>
        <?php
            }}
        ?>
    </select>
    <input type="submit" name="submit" value="Submit">
</form>