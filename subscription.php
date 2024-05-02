<?php
include("includes/includedFiles.php");
?>

<div class="playlistsContainer">

	<div class="gridViewContainer">
		<h2 style="font-size: 60px;">SUBSCRIBE TO PAADU GAJALA</h2>

	</div>

</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free vs Premium</title>
    <style>

        h1,
        h2,
        h3 {
            margin-bottom: 15px;
            text-align: center;
        }

        /* Add Google Fonts for better typography */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('assets/images/artwork/bg3.webp');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .container {
            background: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 40px;
            width: 90%;
            max-width: 960px;
            text-align: center;
        }

        .plans {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .plan {
            padding: 20px;
            border-radius: 5px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .plan:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 16px rgba(0,0,0,0.2);
        }

        .plan.premium {
            background-color: #90ee90;
        }

        .button.green {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .button.green:hover {
            background-color: #45a049;
        }

        .buttonItems {
            margin-top: 20px;
            text-align: center;
        }

        .plan ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .plan li {
            margin-bottom: 10px;
        }

    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css">
</head>
<body>
    <div class="container">
        <h1>Experience the difference</h1>
        <p style="text-align:center;">Go Premium and enjoy full control of your listening. Cancel anytime.</p>
        <h2>Paadu Gajala's Plans</h2>
        <div class="plans">
            <div class="plan free">
                <h3 STYLE="text-align: center;">Free Plan</h3>
                <ul>
                    <li>Ad-supported music listening</li>
                    <li>Limited skips</li>
                    <li>Can't download songs for offline listening</li>
                    <li>Standard audio quality</li>
                    <li>Can't listen with friends in real time</li>
                    <li>Limited control over listening queue</li>
                </ul>
            </div>
            <div class="plan premium">
                <h3>Premium Plan</h3>
                <ul>
                    <li>Ad-free music listening</li>
                    <li>Unlimited skips</li>
                    <li>Download songs for offline listening</li>
                    <li>High audio quality</li>
                    <li>Listen with friends in real time</li>
                    <li>Organize listening queue</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="buttonItems">
            <form action="<?php echo htmlspecialchars("subscription1.php"); ?>">
                <button class="button green" onclick="openPage('subscription1.php')">SUBSCRIBE</button>
            </form>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
                    const buttons = document.querySelectorAll(".button");
                    buttons.forEach(button => {
                        button.addEventListener('click', function(event) {
                            event.preventDefault();
                            const page = this.getAttribute('onclick').match(/'([^']+)'/)[1];
                            window.location.href = page;
                        });
                    });
                });

                // Optional: Add a more complex animation library like AOS (Animate on Scroll)
                document.head.insertAdjacentHTML('beforeend', '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" integrity="sha384-pqc1eIiU6sTv1OpmTzDr1elzyVYc2WRgoMR+GimvclRj2ej5XV5tHbKBH4YLSS7M" crossorigin="anonymous">');
    </script>
                
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>
</html>


