<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>XYZ Kosovo Staff</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fc;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
            padding: 30px 20px 10px;
        }

        header img {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }

        header h1 {
            font-size: 32px;
            margin: 10px 0 5px;
            color: #1a237e;
        }

        header p {
            color: #555;
            font-size: 16px;
        }

        .search-bar {
            max-width: 400px;
            margin: 20px auto;
            text-align: center;
        }

        .search-bar input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .employee-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .employee-card {
            background: white;
            border-radius: 12px;
            width: 280px;
            margin: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .employee-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        .employee-card img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .employee-card p {
            margin: 6px 0;
        }

        .employee-card a {
            color: #0d47a1;
            text-decoration: none;
            font-weight: 500;
        }

        .employee-card a:hover {
            text-decoration: underline;
        }

        @media screen and (max-width: 600px) {
            .employee-card {
                width: 90%;
            }

            header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

<header>
    <img src="assets/logo.png" alt="Company Logo">
    <h1>XponentL Kosovo Employees</h1>
    <p>Lista e të gjithë punonjësve tanë profesionistë</p>
</header>

<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Kërko sipas emrit ose pozitës...">
</div>

<div class="employee-container" id="employeeList">
<?php
include('db.php');

$sql = "SELECT * FROM employees ORDER BY first_name ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $fullName = $row['first_name'] . ' ' . $row['last_name'];
        $position = $row['position'];
        $linkedin = $row['linkedin_url'];
        $photo = !empty($row['photo_url']) ? $row['photo_url'] : 'assets/default.jpg';

        if (!preg_match("/^https?:\/\//", $linkedin)) {
            $linkedin = "https://" . $linkedin;
        }

        echo "<div class='employee-card' data-name='$fullName' data-position='$position'>";
        echo "<img src='$photo' alt='Employee Photo'>";
        echo "<p><strong>$fullName</strong></p>";
        echo "<p>$position</p>";
        if (!empty($linkedin)) {
            echo "<p><a href='$linkedin' target='_blank'>🔗 LinkedIn Profile</a></p>";
        }
        echo "</div>";
    }
} else {
    echo "<p style='text-align:center;'>Asnjë punonjës nuk u gjet.</p>";
}

$conn->close();
?>
</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const cards = document.querySelectorAll('.employee-card');

    searchInput.addEventListener('keyup', function () {
        const query = this.value.toLowerCase();
        cards.forEach(card => {
            const name = card.dataset.name.toLowerCase();
            const position = card.dataset.position.toLowerCase();
            if (name.includes(query) || position.includes(query)) {
                card.style.display = 'inline-block';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>

</body>
</html>
