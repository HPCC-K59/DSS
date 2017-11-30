<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trợ giúp thí sinh lựa chọn ngành nghề</title>

    <?php include APPPATH.'views/common/style.php'?>
    <?php include "style.php" ?>

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url() ?>">Trợ giúp thí sinh lựa chọn ngành nghề</a>
        </div>
        <!-- /.navbar-header -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>"><i class="fa fa-dashboard fa-fw"></i> Tư vấn Ngành nghề</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Quản lý dữ liệu<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url('table') ?>">Table</a>
                            </li>
                            <li>
                                <a href="forms.html">Forms</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="blank.html">Blank Page</a>
                            </li>
                            <li>
                                <a href="login.html">Login Page</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-info">Yêu cầu bạn điền đầy đủ thông tin phía dưới</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!--  <div class="row"> -->
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading text-warning">
                        <i class="fa fa-clock-o fa-fw"></i> <span >Các yêu cầu đầu vào</span>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form action="" method="POST">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-badge"><i class="fa fa-check"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Thông tin cá nhân</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <div role="form">
                                                <div class="form-group">
                                                    <label>Họ và tên</label>
                                                    <input class="form-control" required name="name">
                                                </div>
                                                <div class="form-group">
                                                    <label>Giới tính</label>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="gender" id="optionsRadios1" value="nam" checked>nam
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="gender" id="optionsRadios2" value="nữ">nữ
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-inverted">
                                    <div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Điểm thi đại học của bạn</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <div role="form">
                                                <div class="form-group">
                                                    <label>Điểm Toán</label>
                                                    <input class="form-control" required name="toan" >
                                                    <small class=" text-danger">&nbsp;*Bắt buộc</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Điểm lý</label>
                                                    <input class="form-control" required name="ly" >
                                                    <small class=" text-danger">&nbsp;*Bắt buộc</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Điểm Hoá</label>
                                                    <input class="form-control" required name="hoa" >
                                                    <small class=" text-danger">&nbsp;*Bắt buộc</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Điểm vùng được cộng</label>
                                                    <input class="form-control" required name="diemvung" >
                                                    <small class=" text-danger">&nbsp;*Bắt buộc</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Điểm ưu tiên</label>
                                                    <input class="form-control" required name="diemu tien" >
                                                    <small class=" text-danger">&nbsp;*Bắt buộc</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-badge danger"><i class="fa fa-home"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Chọn trường</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <div class="form-group">
                                                <label>Trường bạn đã chọn là:</label>
                                                <select class="form-control">
                                                    <option>Đại Học Bách Khoa Hà Nội (bka)</option>
                                                    <option>Đại Học Xây Dựng (nuce)</option>
                                                    <option>Đại Học Kinh Tế Quốc Dân (neu)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-inverted">
                                    <div class="timeline-badge success"><i class="fa fa-graduation-cap"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">

                                            <h4 class="timeline-title">Sở thích - Nguyện vọng</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <div class="form-group">
                                                <label>lựa chọn các Ngành mà bạn muốn vào</label>
                                                <select multiple class="form-control">
                                                    <option>Công nghệ thông tin</option>
                                                    <option>Kinh tế</option>
                                                    <option>cơ khí</option>
                                                    <option>điện tử viễn thông</option>
                                                    <option>kỹ thuật vật liệu</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="row text-center">
                                <button type="submit" class="btn btn-success">Xem kết quả</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>


        </div>
    </div>


    <?php include APPPATH.'views/common/script.php' ?>
    <?php include "script.php" ?>

</body>

</html>
