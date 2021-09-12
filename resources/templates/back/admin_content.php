<?php require_once("../../resources/config.php"); ?>

<!-- FIRST ROW WITH PANELS -->
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><span class="glyphicon glyphicon-flag"></span>
            Welcome to kArt dashboard , <small><?php echo get_user_name(); ?></small>
        </h1>
    </div>
</div>
<!-- /.row -->

<div class="row">

    <div class="col-lg-4 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <span class="glyphicon glyphicon-align-left" style="font-size: 60px;"></span>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php countOrder(); ?></div>
                        <div>Total Orders !</div>
                    </div>
                </div>
            </div>
            <a href="index.php?orders">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>


    <div class="col-lg-4 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-fw fa-bar-chart-o" style="font-size: 60px;"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php countProduct(); ?></div>
                        <div>Products!</div>
                    </div>
                </div>
            </div>
            <a href="index.php?products">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-fw fa-list" style="font-size: 60px;"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php countCategory(); ?></div>
                        <div>Categories!</div>
                    </div>
                </div>
            </div>
            <a href="index.php?categories">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>


</div>

<!-- /.row -->


<!-- SECOND ROW WITH TABLES-->
<div class="row">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Order_Id</th>
                    <th>Order_Amount</th>
                    <th>Order_Transaction</th>
                    <th>Order_Currency</th>
                    <th>Order_Status</th>
                </tr>
            </thead>
            <tbody>
                <?php //display_admin_orders(); 
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /.row -->