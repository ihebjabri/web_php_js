<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  
    header("Location: login.php");
    exit();
}


?>



<!DOCTYPE html>

<html lang="en">
<?php include 'include/head.php';?>

<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
    var defaultThemeMode = "light";
    var themeMode;

    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }

        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }

        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
    </script>
    <!--end::Theme mode setup on page load-->



    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">


            <?php include 'include/header.php';?>
            <!--begin::Wrapper-->
            <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">

                <?php include 'include/sidebar.php';?>




                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">

                        <!--begin::Toolbar-->
                        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

                            <!--begin::Toolbar container-->
                            <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



                                <!--begin::Page title-->
                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                                    <!--begin::Title-->
                                    <h1
                                        class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                                        Gestion Etudiants
                                    </h1>
                                    <!--end::Title-->


                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                            <a href="/metronic8/demo1/index.html" class="text-muted text-hover-primary">
                                                Tekup </a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                            Etudiants </li>
                                        <!--end::Item-->

                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                                <!--begin::Actions-->
                                <div class="d-flex align-items-center gap-2 gap-lg-3">

                                    <!--end::Secondary button-->

                                    <!--begin::Primary button-->
                                    <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_create_app">
                                        Ajouter </a>
                                    <!--end::Primary button-->
                                </div>
                                <!--end::Actions-->

                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->

                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content  flex-column-fluid ">


                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container  container-xxl ">





                                <!--begin::Tab Content-->
                                <div class="tab-content">

                                    <?php include 'database/db_connexion.php'; ?>

                                    <!--begin::Card-->
                                    <div class="card card-flush ">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Table container-->
                                            <div class="table-responsive">
                                                <!--begin::Table-->
                                                <table id="kt_project_users_table"
                                                    class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                                                    <thead class="fs-7 text-gray-500 text-uppercase">
                                                        <tr>
                                                            <th class="min-w-250px"> Etudiant </th>
                                                            <th class="min-w-90px"> Date Naissance </th>
                                                            <th class="min-w-90px">Class</th>
                                                            <th class="min-w-90px">Statut</th>
                                                            <th class="min-w-50px text-end">Details</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fs-6">
                                                        <?php
                    try {
                        // Fetch the students
                        $stmt = $pdo->query("SELECT * FROM students");
                        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($students as $student):
                    ?>
                                                        <tr>
                                                            <td>
                                                                <!--begin::User-->
                                                                <div class="d-flex align-items-center">
                                                                    <!--begin::Wrapper-->
                                                                    <div class="me-5 position-relative">
                                                                        <!--begin::Avatar-->
                                                                        <div class="symbol symbol-35px symbol-circle">
                                                                            <span
                                                                                class="symbol-label bg-light-danger text-danger fw-semibold">
                                                                                <?= htmlspecialchars(substr($student['first_name'], 0, 1)) ?></span>
                                                                        </div>
                                                                        <!--end::Avatar-->

                                                                        <!--begin::Online-->
                                                                        <div
                                                                            class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1">
                                                                        </div>
                                                                        <!--end::Online-->
                                                                    </div>
                                                                    <!--end::Wrapper-->

                                                                    <!--begin::Info-->
                                                                    <div
                                                                        class="d-flex flex-column justify-content-center">
                                                                        <a href=""
                                                                            class="mb-1 text-gray-800 text-hover-primary"><?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></a>
                                                                        <div class="fw-semibold fs-6 text-gray-500">
                                                                            <?= htmlspecialchars($student['first_name'] . '@corpmail.com') ?>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Info-->
                                                                </div>
                                                                <!--end::User-->
                                                            </td>
                                                            <td><?= htmlspecialchars(date('M d, Y', strtotime($student['birthday']))) ?>
                                                            </td>
                                                            <td><?= htmlspecialchars($student['classroom']) ?></td>
                                                            <td>
                                                                <?php if($student['status'] === 'active'){ ?>
                                                                <span
                                                                    class="badge badge-light-success fw-bold px-4 py-3">
                                                                    <?= htmlspecialchars($student['status']) ?>
                                                                </span>
                                                                <?php }else{ ?>
                                                                <span
                                                                    class="badge badge-light-danger fw-bold px-4 py-3">
                                                                    <?= htmlspecialchars($student['status']) ?>
                                                                </span>
                                                                <?php } ?>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="modifier.php?id=<?= htmlspecialchars($student['id']) ?>"
                                                                    class="btn btn-light-primary btn-sm">Modifier</a>

                                                                <a href="database/delete_student.php?id=<?= htmlspecialchars($student['id']) ?>"
                                                                    class="btn btn-light-danger btn-sm">Delete</a>
                                                            </td>
                                                        </tr>
                                                        <?php
                        endforeach;
                    } catch (PDOException $e) {
                        echo "Query failed: " . $e->getMessage();
                    }
                    ?>
                                                    </tbody>
                                                </table>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Table container-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->

                                </div>
                                <!--end::Tab Content-->


                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->

                    </div>
                    <!--end::Content wrapper-->


                    <?php include 'include/footer.php'; ?>
                </div>
                <!--end:::Main-->


            </div>
            <!--end::Wrapper-->


        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->


    <!--end::Engage modals-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up"><span class="path1"></span><span class="path2"></span></i>
    </div>
    <!--end::Scrolltop-->

    <!--begin::Modals-->
























    <!--begin::Javascript-->
    <script>
    var hostUrl = "/metronic8/demo1/assets/";
    </script>

    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="https://preview.keenthemes.com/metronic8/demo1/assets/plugins/global/plugins.bundle.js"></script>
    <script src="https://preview.keenthemes.com/metronic8/demo1/assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->

    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="https://preview.keenthemes.com/metronic8/demo1/assets/plugins/custom/datatables/datatables.bundle.js">
    </script>
    <!--end::Vendors Javascript-->


    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>