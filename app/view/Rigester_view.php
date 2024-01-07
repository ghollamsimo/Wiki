<!DOCTYPE html>
<html lang="en">

<?php
require_once (__DIR__ . '/../../include/head.php');
?>
<link rel="stylesheet" href="/wiki/public/style/auth.css">

<title>Auth</title>

<body>

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body">
                    <div class="logo app-brand justify-content-center">

                        <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">

                                </span>
                            <span class="app-brand-text demo text-body fw-bold">Wiki</span>
                        </a>
                    </div>

                    <h4 class="mb-2">Welcom To Wiki</h4>
                    <p class="mb-4">Make your app management easy and fun!</p>

                    <form id="formAuthentication" class="mb-3" method="post" action="">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                   placeholder="Enter your username" autofocus />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                   placeholder="Enter your email" />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                       placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                       aria-describedby="password" />
                                <!-- <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span> -->
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="file" class="form-control" name="image" id="inputGroupFile01">
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms-conditions"
                                       name="terms" />
                                <label class="form-check-label" for="terms-conditions">
                                    I agree to
                                    <a href="javascript:void(0);">privacy policy & terms</a>
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-primary d-grid w-100" name="submitInfo">Sign up</button>
                    </form>

                    <p class="text-center">
                        <span>Already have an account?</span>
                        <a href="/wiki/public/login">
                            <span>Sign in instead</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>