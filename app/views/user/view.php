<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #000000, #003d1a);
            margin: 0;
            padding: 20px;
            color: #00ff88;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #00ff88;
            text-shadow: 2px 2px 8px rgba(0,255,136,0.8);
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            box-shadow: 0px 8px 20px rgba(0,255,136,0.4);
            border-radius: 12px;
            overflow: hidden;
            background: #1a1a1a;
            color: #00ff88;
        }

        th, td {
            padding: 15px 20px;
            text-align: center;
        }

        th {
            background: linear-gradient(135deg, #00ff88, #006633);
            color: #000;
            font-size: 18px;
        }

        tr:nth-child(even) {
            background: #262626;
        }

        tr:nth-child(odd) {
            background: #1a1a1a;
        }

        tr:hover {
            background: #003d20;
            color: #00ff88;
            transform: scale(1.02);
            box-shadow: 0px 5px 15px rgba(0,255,136,0.6);
        }

        a {
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: bold;
            transition: 0.3s;
        }

        a[href*="update"] {
            background: #00cc66;
            color: black;
            box-shadow: 0 4px 6px rgba(0,255,136,0.4);
        }

        a[href*="update"]:hover {
            background: #00ff88;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,255,136,0.6);
        }

        a[href*="delete"] {
            background: #cc0000;
            color: white;
            box-shadow: 0 4px 6px rgba(255,0,0,0.3);
        }

        a[href*="delete"]:hover {
            background: #ff1a1a;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(255,0,0,0.5);
        }
    </style>
</head>
<body>
    <h1>Student List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>

        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id']; ?></td>
                <td><?= $user['username']; ?></td>
                <td><?= $user['email']; ?></td>
                <td>
                    <a href="<?= site_url('user/update/'.$user['id']); ?>">Edit</a> |
                    <a href="<?= site_url('user/delete/'.$user['id']); ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
