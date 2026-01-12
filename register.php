<?php
    include 'includes/dbh.inc.php';
    include 'components/icons.php';
    $classQuery = "SELECT * FROM classes";
    $classResult = mysqli_query($conn, $classQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> 
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Register</title>
</head>
<body>
    <form action="includes/registerFormhandler.inc.php" method="post">
        <div class="w-full min-h-screen bg-black p-1 lg:p-3 flex justify-end">
            <div class="w-full lg:w-1/2 pb-5 bg-zinc-50 rounded-md flex justify-center items-center">
                <div class="w-11/12 lg:w-3/4 flex flex-col gap-8">
                    <div>
                        <h1 class=" text-4xl font-bold">Get Started!</h1>
                        <p class=" text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                    <div class="w-full flex flex-col gap-4">
                        <div class="flex flex-col">
                            <div class="w-full flex gap-2 items-center border-b-2 p-3 <?= (isset($_GET['error']) && ($_GET['error'] === 'emptyfields') && ($_GET['email'] === '') ? 'border-red-500' : 'border-zinc-400') ?>">
                                <?php renderIcon('email', 'w-6 h-6') ?>
                                <input
                                    type="text" 
                                    name="email" 
                                    placeholder="Enter your e-mail..."
                                    required
                                    value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>"    
                                    class="w-full outline-none font-semibold"
                                />
                            </div>
                            <?php 
                                if (isset($_GET['error']) && ($_GET['error'] === 'emptyfields') && ($_GET['email'] === '')) { echo '
                                    <p class="text-red-500 text-xs self-end">
                                        This field is empty
                                    </p>';
                                }
                            ?> 
                        </div>
                        <div class="flex flex-col">
                            <div class="w-full flex gap-2 items-center border-b-2 p-3 <?= (isset($_GET['error']) && ($_GET['error'] === 'emptyfields') && ($_GET['surname'] === '') ? 'border-red-500' : 'border-zinc-400') ?>">
                                <?php renderIcon('name', 'w-6 h-6') ?>
                                <input 
                                    type="text" 
                                    name="surname" 
                                    placeholder="Enter your Surname..."
                                    required
                                    value="<?= isset($_GET['surname']) ? htmlspecialchars($_GET['surname']) : '' ?>" 
                                    class="w-full outline-none font-semibold"
                                />
                            </div>
                            <?php 
                                if (isset($_GET['error']) && ($_GET['error'] === 'emptyfields') && ($_GET['surname'] === '')) { echo '
                                    <p class="text-red-500 text-xs self-end">
                                        This field is empty
                                    </p>';
                                }
                            ?> 
                        </div>
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="w-1/2 flex gap-2 items-center border-b-2 p-3 <?= (isset($_GET['error']) && ($_GET['error'] === 'emptyfields') && ($_GET['firstname'] === '') ? 'border-red-500' : 'border-zinc-400') ?>">
                                <?php renderIcon('name', 'w-6 h-6') ?>
                                <input 
                                    type="text" 
                                    name="firstname" 
                                    placeholder="Enter your firstname..."
                                    required
                                    value="<?= isset($_GET['firstname']) ? htmlspecialchars($_GET['firstname']) : '' ?>" 
                                    class="w-full outline-none font-semibold"
                                />
                            </div>
                            <?php 
                                if (isset($_GET['error']) && ($_GET['error'] === 'emptyfields') && ($_GET['firstname'] === '')) { echo '
                                    <p class="text-red-500 text-xs self-end">
                                        This field is empty
                                    </p>';
                                }
                            ?> 
                            <div class="w-1/2 flex gap-2 items-center border-b-2 p-3 <?= (isset($_GET['error']) && ($_GET['error'] === 'emptyfields') && ($_GET['othername'] === '') ? 'border-red-500' : 'border-zinc-400') ?>">
                                <?php renderIcon('name', 'w-6 h-6') ?>
                                <input 
                                    type="text" 
                                    name="othername" 
                                    placeholder="Enter your othernames..."
                                    required
                                    value="<?= isset($_GET['othername']) ? htmlspecialchars($_GET['othername']) : '' ?>" 
                                    class="w-full outline-none font-semibold"
                                />
                            </div>
                            <?php 
                                if (isset($_GET['error']) && ($_GET['error'] === 'emptyfields') && ($_GET['othername'] === '')) { echo '
                                    <p class="text-red-500 text-xs self-end">
                                        This field is empty
                                    </p>';
                                }
                            ?> 
                        </div>
                        <div class="w-full flex justify-between gap-4">
                            <div class="w-full flex flex-col">
                                <div class="w-full flex gap-2 items-center border-b-2 p-3 <?= (isset($_GET['error']) && ($_GET['error'] === 'emptyfields') && (isset($_GET['role']) && $_GET['role'] === 'none') ? 'border-red-500' : 'border-zinc-400') ?>">
                                    <select 
                                        name="role" 
                                        class="w-full outline-none"
                                        required
                                    >
                                        <option value="">-- Select role --</option>
                                        <option value="student">Student</option>
                                        <option value="teacher">Teacher</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-col w-full">
                                <div class="w-full flex gap-2 items-center border-b-2 border-zinc-400 p-3">
                                    <select name="class_id" id="class" class="w-full outline-none">
                                        <option value="">-- Select Class --</option>
                                        <?php while ($class = mysqli_fetch_assoc($classResult)) : ?>
                                        <option value="<?= $class['id'] ?>">
                                            <?= htmlspecialchars($class['class_name']) ?>
                                        </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="w-full flex justify-between gap-4">
                            <div class="flex flex-col">
                                <div class="w-full flex gap-2 items-center border-b-2 border-zinc-400 p-3">
                                    <input type="date" name="dob" required class="w-full outline-none" />
                                </div>
                            </div>
                            <div class="flex flex-col w-full">
                                <div class="w-full flex gap-2 items-center border-b-2 border-zinc-400 p-3">
                                    <select name="gender" required class="w-full outline-none">
                                        <option value="">-- Select Sex --</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="w-full flex flex-col md:flex-row justify-between gap-4">
                            <div class="flex flex-col w-full">
                                <div class="w-full flex gap-2 items-center border-b-2 border-zinc-400 p-3">
                                    <?php renderIcon('password', 'w-6 h-6') ?>
                                    <input type="password" name="pwd" placeholder="password" required class="w-full outline-none" />
                                </div>
                            </div>
                            <div class="flex flex-col w-full">
                                <div class="w-full flex gap-2 items-center border-b-2 border-zinc-400 p-3">
                                    <?php renderIcon('password', 'w-6 h-6') ?>
                                    <input type="password" name="confirmPwd" placeholder="confirm password" required class="w-full outline-none" />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2 justify-end items-end mt-2">
                            <button class="bg-black/90 hover:bg-black transition-all duration-300 cursor-pointer w-full text-zinc-50 p-3 font-semibold rounded-full">Register</button>
                            <a href="login.php" class="hover:text-red-500 text-blue-400 text-xs border-b border-dotted border-blue-400">I already have an account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>