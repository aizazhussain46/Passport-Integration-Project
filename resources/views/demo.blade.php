@extends('master')
@section("feedback_form")

<div class="row">
    <div class="col-md-12">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}">Feedback <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <div class="form-inline my-2 my-lg-0">
      <a href="" class="btn btn-outline-success my-2 my-sm-0">Logout</a>
    </div>
  </div>
</nav>
    </div>    
</div>
<div class="row">
    <div class="col-md-12 mt-5">
    <?php
    if($errors->first('feedback')){
        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $errors->first('feedback'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
    
    if(session('msg')){
        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo session('msg'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
    ?>

    <form method="POST" action="/submit-feedback">  
    
    <div class="form-group">
    <label for="feedback">Your Feedback</label>
    <textarea name="feedback" class="form-control" id="feedback" rows="10" placeholder="Share your Thoughts here....."></textarea>
  </div>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-success btn-lg btn-block" name="feedback_submit">Submit</button>
    </form>
    </div>
</div>
@endsection