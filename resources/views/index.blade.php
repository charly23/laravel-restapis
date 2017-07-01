@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row">

        <div class="header col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Rest APIs : Library (TEST)</div>
            </div>
        </div>

        <div class="container col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">

                    <?php
                        // new \App\library\submit;
                        $search = isset($_GET['search'])?trim($_GET['search']):null;
                    ?>

                    <!-- forms -->
                    <form action="" method="GET" class="form-panel">
                        <input type="text" name="search" value="<?php echo $search; ?>" />
                        <button type="submit">
                            Search Location
                        </button>
                    </form><!-- forms - END -->

                    <?php
                        submit::actions($search);
                    ?>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection


