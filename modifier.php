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


                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->



                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content  flex-column-fluid ">


                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container  container-xxl ">
                                <!--begin::Form-->

                                <?php
                                    include 'database/db_connexion.php';

                                    if (isset($_GET['id'])) {
                                        $id = $_GET['id'];

                                        try {
                                            $pdo = new PDO($dsn, $user, $password, $options);
                                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                            $sql = "SELECT * FROM students WHERE id = :id";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                                            $stmt->execute();

                                            $student = $stmt->fetch(PDO::FETCH_ASSOC);

                                            if ($student) {
                                                $first_name = $student['first_name'];
                                                $last_name = $student['last_name'];
                                                $classroom = $student['classroom'];
                                                $birthday = $student['birthday'];
                                                $status = $student['status']; 
                                            } else {
                                                echo "Étudiant non trouvé";
                                            }
                                        } catch (PDOException $e) {
                                            echo "Erreur : " . $e->getMessage();
                                        }
                                    } else {
                                        echo "ID de l'étudiant non spécifié";
                                    }
                                    ?>
                                <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row"
                                    method="POST" action="database/update_student.php">
                                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" role="tab-panel">
                                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                                    <div class="card card-flush py-4">
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <h2>Modifier Étudiant</h2>
                                                            </div>
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <div class="mb-10 fv-row">
                                                                <label class="required form-label">Nom</label>
                                                                <input type="text" name="first_name"
                                                                    class="form-control mb-2" placeholder="Nom"
                                                                    value="<?php echo $first_name; ?>" required />
                                                            </div>
                                                            <div class="mb-10 fv-row">
                                                                <label class="required form-label">Prénom</label>
                                                                <input type="text" name="last_name"
                                                                    class="form-control mb-2" placeholder="Prénom"
                                                                    value="<?php echo $last_name; ?>" required />
                                                            </div>
                                                            <div class="mb-10 fv-row">
                                                                <label class="required form-label">Class</label>
                                                                <input type="text" name="classroom"
                                                                    class="form-control mb-2" placeholder="Class"
                                                                    value="<?php echo $classroom; ?>" required />
                                                            </div>
                                                            <div class="mb-10 fv-row">
                                                                <label class="required form-label">Date
                                                                    Naissance</label>
                                                                <input type="date" name="birthday"
                                                                    class="form-control mb-2"
                                                                    value="<?php echo $birthday; ?>" required />
                                                            </div>

                                                            <div class="mb-10 fv-row">
                                                                <label class="required form-label">Date
                                                                    Status</label>
                                                                <select name="status" id="" class="form-select">
                                                                    <option value=""></option>
                                                                    <option
                                                                        <?php if($status === 'active')   echo "selected";  ?>
                                                                        value="active"> Active</option>
                                                                    <option
                                                                        <?php if($status !== 'active')   echo "selected";  ?>
                                                                        value="inactive">Inactive</option>
                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-light me-5">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <span class="indicator-label">Submit</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <!--end::Form-->

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