<?php
session_start();

if (empty($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';
?>

<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAWFINDER - Community Pet System</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

    <div class="top-bar">
        <div class="role-container">
            <span class="role-label">Active Session Role:</span>
            <span class="role-badge">Admin / Staff</span>
        </div>
    </div>

    <header class="navbar">
        <div class="brand-section">
            <img src="image/logo2.jpg" alt="PAWFINDER Logo" class="brand-logo-img" onerror="this.src='https://placehold.co/42x42/0d9488/ffffff?text=PF'">
            <div>
                <span class="brand-title">PAWFINDER</span>
                <span class="brand-subtitle">COMMUNITY PET SYSTEM</span>
            </div>
        </div>

        <ul class="nav-links">
            <li class="nav-item"><a href="admin.php">Home</a></li>
            <li class="nav-item"><a href="adopt.php">Adopt Pets</a></li>
            <li class="nav-item"><a href="rescues.php">Emergency Rescues</a></li>
            <li class="nav-item"><a href="health_drives.php">Health Drives</a></li>
            <li class="nav-item"><a href="contact.php">Contact</a></li>
        </ul>

       <div class="auth-actions">
         <a href="homepage.php" class="btn-logout"
             onclick="return confirm('Are you sure you want to log out?');">
        Log Out
         </a>
        </div>
    </header>

    <main class="content-area">
        <div class="hero-banner">
            <h1>Welcome to Pawfinder!</h1>
            <p>Creating a safer community by connecting rescued pets with responsible and loving owners</p>
        </div>

        <section class="partners-section">
            <div class="partners-header">
                <h2>Our Partner Shelters</h2>
                <p>
                    When rescued animals or pets available for adoption remain unadopted for an extended period, 
                    they are safely transferred to larger partner facilities for long-term shelter, rehabilitation, and specialized care.
                </p>
            </div>

            <div class="shelter-cards-grid">
                <div class="shelter-card">
                    <div>
                        <img src="image/afk.jpg" alt="AKF Animal Rescue" class="shelter-img" onerror="this.src='https://placehold.co/280x150/f1f5f9/0d9488?text=AKF'">
                        <div class="shelter-name">Animal Kingdom Foundation (AKF)</div>
                        <div class="shelter-meta">★ 4.5 (2 reviews) • Verified</div>
                        <div class="shelter-category">Animal Shelters • Community Service / Non-Profit</div>
                        <div class="shelter-info">
                            <strong>Address:</strong> No. 8, Purante Street, Cub-Cub, Capas, Tarlac<br>
                            <strong>Contact:</strong> +63 939 914 2403
                        </div>
                    </div>
                    <a href="https://animalkingdomfoundation.org" target="_blank" class="shelter-link">Visit Website / Page →</a>
                </div>

                <div class="shelter-card">
                    <div>
                        <img src="image/part.jpg" alt="Philippine Animal Rescue Team" class="shelter-img" onerror="this.src='https://placehold.co/280x150/f1f5f9/0d9488?text=PART'">
                        <div class="shelter-name">Philippine Animal Rescue Team (PART)</div>
                        <div class="shelter-meta">★ 4.8 • Verified Sanctuary</div>
                        <div class="shelter-category">No-Kill Animal Shelter • Rehabilitation Center</div>
                        <div class="shelter-info">
                            <strong>Address:</strong> San Jose del Monte, Bulacan<br>
                            <strong>Contact:</strong> +63 917 859 2928
                        </div>
                    </div>
                    <a href="https://www.philippineanimalrescueteam.org" target="_blank" class="shelter-link">Visit Website / Page →</a>
                </div>

                <div class="shelter-card">
                    <div>
                        <img src="image/paw.jpg" alt="PAWS Philippines" class="shelter-img" onerror="this.src='https://placehold.co/280x150/f1f5f9/0d9488?text=PAWS'">
                        <div class="shelter-name">Philippine Animal Welfare Society (PAWS)</div>
                        <div class="shelter-meta">★ 4.9 • Verified Organization</div>
                        <div class="shelter-category">Animal Welfare • Spay & Neuter Clinic</div>
                        <div class="shelter-info">
                            <strong>Address:</strong> Aurora Blvd., Katipunan Valley, Loyola Heights, Quezon City<br>
                            <strong>Contact:</strong> +63 2 8475 1686
                        </div>
                    </div>
                    <a href="https://paws.org.ph" target="_blank" class="shelter-link">Visit Website / Page →</a>
                </div>
            </div>
        </section>

        <section class="layer-slider-section">
            <div class="section-header-row">
                <h2 class="section-header-title">Dogs for Adoption</h2>
                <div class="section-action-group">
                    <input type="text" class="search-box" placeholder="Search dogs...">
                    <button class="btn-add-item" onclick="location.href='add.php'">+ Add</button>
                </div>
            </div>
            <div class="slider-wrapper">
                <button class="slider-btn slider-btn-left">‹</button>
                <div class="slider-container">
                    <?php
                    $sql_dogs = "SELECT * FROM pets WHERE LOWER(pet_species) LIKE '%dog%' ORDER BY id DESC";
                    $result_dogs = mysqli_query($conn, $sql_dogs);

                    if ($result_dogs && mysqli_num_rows($result_dogs) > 0) {
                        while ($row = mysqli_fetch_assoc($result_dogs)) {
                    ?>
                            <div class="pet-card" style="min-width: 220px; background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px; display: flex; flex-direction: column; gap: 8px;">
                                <img src="<?php echo htmlspecialchars($row['pet_photo']); ?>" alt="<?php echo htmlspecialchars($row['pet_name']); ?>" style="width: 100%; height: 140px; object-fit: cover; border-radius: 8px;">
                                <div style="font-size: 16px; font-weight: 700; color: #0f172a;"><?php echo htmlspecialchars($row['pet_name']); ?></div>
                                <div style="font-size: 12px; color: #64748b;"><?php echo htmlspecialchars($row['breed']); ?> • <?php echo htmlspecialchars($row['age']); ?></div>
                                <div style="font-size: 11px; color: #0d9488; font-weight: bold;">Barangay: <?php echo htmlspecialchars($row['barangay']); ?></div>
                                <a href="pet_details.php?id=<?php echo $row['id']; ?>" style="margin-top: auto; text-align: center; text-decoration: none; background-color: #f1f5f9; color: #0d9488; border: 1px solid #ccfbf1; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">View Details &gt;</a>
                                <div style="display: flex; gap: 6px; margin-top: 4px;">
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" style="flex: 1; text-align: center; text-decoration: none; background: #e2e8f0; color: #0f172a; padding: 4px; border-radius: 4px; font-size: 11px; font-weight: bold;">Edit</a>
                                    <a href="delete_pet.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this pet?')" style="flex: 1; text-align: center; text-decoration: none; background: #fee2e2; color: #991b1b; padding: 4px; border-radius: 4px; font-size: 11px; font-weight: bold;">Del</a>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p style='padding: 10px; color: #64748b;'>No dogs available for adoption right now.</p>";
                    }
                    ?>
                </div>
                <button class="slider-btn slider-btn-right">›</button>
            </div>
        </section>

        <section class="layer-slider-section">
            <div class="section-header-row">
                <h2 class="section-header-title">Cats for Adoption</h2>
                <div class="section-action-group">
                    <input type="text" class="search-box" placeholder="Search cats...">
                    <button class="btn-add-item" onclick="location.href='add.php'">+ Add</button>
                </div>
            </div>
            <div class="slider-wrapper">
                <button class="slider-btn slider-btn-left">‹</button>
                <div class="slider-container">
                    <?php
                    $sql_cats = "SELECT * FROM pets WHERE LOWER(pet_species) LIKE '%cat%' ORDER BY id DESC";
                    $result_cats = mysqli_query($conn, $sql_cats);

                    if ($result_cats && mysqli_num_rows($result_cats) > 0) {
                        while ($row = mysqli_fetch_assoc($result_cats)) {
                    ?>
                            <div class="pet-card" style="min-width: 220px; background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px; display: flex; flex-direction: column; gap: 8px;">
                                <img src="<?php echo htmlspecialchars($row['pet_photo']); ?>" alt="<?php echo htmlspecialchars($row['pet_name']); ?>" style="width: 100%; height: 140px; object-fit: cover; border-radius: 8px;">
                                <div style="font-size: 16px; font-weight: 700; color: #0f172a;"><?php echo htmlspecialchars($row['pet_name']); ?></div>
                                <div style="font-size: 12px; color: #64748b;"><?php echo htmlspecialchars($row['breed']); ?> • <?php echo htmlspecialchars($row['age']); ?></div>
                                <div style="font-size: 11px; color: #0d9488; font-weight: bold;">Barangay: <?php echo htmlspecialchars($row['barangay']); ?></div>
                                <a href="pet_details.php?id=<?php echo $row['id']; ?>" style="margin-top: auto; text-align: center; text-decoration: none; background-color: #f1f5f9; color: #0d9488; border: 1px solid #ccfbf1; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">View Details &gt;</a>
                                <div style="display: flex; gap: 6px; margin-top: 4px;">
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" style="flex: 1; text-align: center; text-decoration: none; background: #e2e8f0; color: #0f172a; padding: 4px; border-radius: 4px; font-size: 11px; font-weight: bold;">Edit</a>
                                    <a href="delete_pet.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this pet?')" style="flex: 1; text-align: center; text-decoration: none; background: #fee2e2; color: #991b1b; padding: 4px; border-radius: 4px; font-size: 11px; font-weight: bold;">Del</a>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p style='padding: 10px; color: #64748b;'>No cats available for adoption right now.</p>";
                    }
                    ?>
                </div>
                <button class="slider-btn slider-btn-right">›</button>
            </div>
        </section>

        <section class="layer-slider-section">
            <div class="section-header-row">
                <h2 class="section-header-title">Birds for Adoption</h2>
                <div class="section-action-group">
                    <input type="text" class="search-box" placeholder="Search birds...">
                    <button class="btn-add-item" onclick="location.href='add.php'">+ Add</button>
                </div>
            </div>
            <div class="slider-wrapper">
                <button class="slider-btn slider-btn-left">‹</button>
                <div class="slider-container">
                    <?php
                    $sql_birds = "SELECT * FROM pets WHERE LOWER(pet_species) LIKE '%bird%' ORDER BY id DESC";
                    $result_birds = mysqli_query($conn, $sql_birds);

                    if ($result_birds && mysqli_num_rows($result_birds) > 0) {
                        while ($row = mysqli_fetch_assoc($result_birds)) {
                    ?>
                            <div class="pet-card" style="min-width: 220px; background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px; display: flex; flex-direction: column; gap: 8px;">
                                <img src="<?php echo htmlspecialchars($row['pet_photo']); ?>" alt="<?php echo htmlspecialchars($row['pet_name']); ?>" style="width: 100%; height: 140px; object-fit: cover; border-radius: 8px;">
                                <div style="font-size: 16px; font-weight: 700; color: #0f172a;"><?php echo htmlspecialchars($row['pet_name']); ?></div>
                                <div style="font-size: 12px; color: #64748b;"><?php echo htmlspecialchars($row['breed']); ?> • <?php echo htmlspecialchars($row['age']); ?></div>
                                <div style="font-size: 11px; color: #0d9488; font-weight: bold;">Barangay: <?php echo htmlspecialchars($row['barangay']); ?></div>
                                <a href="pet_details.php?id=<?php echo $row['id']; ?>" style="margin-top: auto; text-align: center; text-decoration: none; background-color: #f1f5f9; color: #0d9488; border: 1px solid #ccfbf1; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">View Details &gt;</a>
                                <div style="display: flex; gap: 6px; margin-top: 4px;">
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" style="flex: 1; text-align: center; text-decoration: none; background: #e2e8f0; color: #0f172a; padding: 4px; border-radius: 4px; font-size: 11px; font-weight: bold;">Edit</a>
                                    <a href="delete_pet.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this pet?')" style="flex: 1; text-align: center; text-decoration: none; background: #fee2e2; color: #991b1b; padding: 4px; border-radius: 4px; font-size: 11px; font-weight: bold;">Del</a>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p style='padding: 10px; color: #64748b;'>No birds available for adoption right now.</p>";
                    }
                    ?>
                </div>
                <button class="slider-btn slider-btn-right">›</button>
            </div>
        </section>

        <section class="layer-slider-section">
            <div class="section-header-row">
                <h2 class="section-header-title">Free Medicine & Vaccination Schedule</h2>
                <div class="section-action-group">
                    <input type="text" class="search-box" placeholder="Search schedules...">
                    <button class="btn-add-item" onclick="location.href='addschedule.php'">+ Add</button>
                </div>
            </div>
            <table class="med-schedule-table">
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Location / Barangay</th>
                        <th>Services Offered</th>
                        <th>Status</th>
                        <th style="width: 120px; text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_sched = "SELECT * FROM schedules ORDER BY event_date DESC";
                    $result_sched = mysqli_query($conn, $sql_sched);

                    if ($result_sched && mysqli_num_rows($result_sched) > 0) {
                        while ($row = mysqli_fetch_assoc($result_sched)) {
                    ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['event_date']); ?> <br><small><?php echo htmlspecialchars($row['event_time']); ?></small></td>
                                <td><?php echo htmlspecialchars($row['barangay']); ?> <br><small><?php echo htmlspecialchars($row['venue']); ?></small></td>
                                <td><?php echo htmlspecialchars($row['services']); ?></td>
                                <td><span style="font-weight: bold; color: #0d9488;"><?php echo htmlspecialchars($row['status']); ?></span></td>
                                <td style="text-align: center;">
                                    <a href="edit_schedule.php?id=<?php echo $row['id']; ?>" style="background: #e2e8f0; color: #0f172a; text-decoration: none; padding: 4px 8px; border-radius: 4px; font-size: 11px;">Edit</a>
                                    <a href="delete_schedule.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this schedule?')" style="background: #fee2e2; color: #991b1b; text-decoration: none; padding: 4px 8px; border-radius: 4px; font-size: 11px;">Del</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align: center; color: #64748b; padding: 15px;'>No vaccination schedules available.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

     
        <section class="layer-slider-section">
            <div class="section-header-row">
                <h2 class="section-header-title">Missing & Found Stray Pets (Reported Outside)</h2>
                <div class="section-action-group">
                    <input type="text" class="search-box" placeholder="Search strays...">
                    <button class="btn-add-item" onclick="location.href='report.php'">+ Add</button>
                </div>
            </div>
            <div class="slider-wrapper">
                <button class="slider-btn slider-btn-left">‹</button>
                <div class="slider-container">
                    <div class="pet-card" style="min-width: 220px; background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px; display: flex; flex-direction: column; gap: 8px;">
                        <img src="https://placehold.co/220x140/f1f5f9/0d9488?text=Stray+Photo" alt="Missing Pet" style="width: 100%; height: 140px; object-fit: cover; border-radius: 8px;">
                        <div style="font-size: 16px; font-weight: 700; color: #0f172a;">------------</div>
                        <div style="font-size: 12px; color: #64748b;">------------</div>
                        <div style="font-size: 11px; color: #0d9488; font-weight: bold;">Barangay: ------------</div>
                        <a href="pet_details.html" style="margin-top: auto; text-align: center; text-decoration: none; background-color: #f1f5f9; color: #0d9488; border: 1px solid #ccfbf1; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">View Details &gt;</a>
                        <div style="display: flex; gap: 6px; margin-top: 4px;">
                            <button style="flex: 1; background: #e2e8f0; border: none; padding: 4px; border-radius: 4px; font-size: 11px; font-weight: bold; cursor: pointer;">Edit</button>
                            <button style="flex: 1; background: #fee2e2; color: #991b1b; border: none; padding: 4px; border-radius: 4px; font-size: 11px; font-weight: bold; cursor: pointer;">Del</button>
                        </div>
                    </div>
                </div>
                <button class="slider-btn slider-btn-right">›</button>
            </div>
        </section>

    </main>

</body>
</html>