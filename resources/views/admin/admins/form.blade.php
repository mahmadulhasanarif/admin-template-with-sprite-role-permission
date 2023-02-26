@extends('admin.layouts.master')
@section('main')
<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="page-title">Form validation</h2>
        <p class="text-muted">Provide valuable, actionable feedback to your users with HTML5 form validation</p>
        <div class="row">
          <div class="col-md-9">
            <div class="card shadow mb-4">
              <div class="card-header">
                <strong class="card-title">Default Validation</strong>
              </div>
              <div class="card-body">
                <form class="needs-validation" novalidate>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationCustomUsername">Username</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                          </div>
                          <input type="text" name="name" class="form-control" placeholder="Recipient's username" required>
                          <div class="invalid-feedback"> Please choose a username. </div>
                        </div>
                      </div>

                    <div class="col-md-6 mb-3">
                        <label for="simple-select2">Useremail</label>
                        <div class="input-group mb-3">
                          <input type="email" name="email" class="form-control" placeholder="Recipient's useremail" required>
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">@email.com</span>
                          </div>
                          <div class="invalid-feedback"> Please choose a email. </div>
                        </div>
                    </div>
                   
                    <div class="col-md-6 mb-3">
                        <label for="multi-select2">Multiple Select</label>
                        <select class="form-control select2-multi" id="multi-select2" required>
                          <optgroup label="Mountain Time Zone">
                            <option value="AZ">Arizona</option>
                            <option value="CO">Colorado</option>
                            <option value="ID">Idaho</option>
                          </optgroup>
                          <optgroup label="Central Time Zone">
                            <option value="AL">Alabama</option>
                            <option value="AR">Arkansas</option>
                            <option value="IL">Illinois</option>
                          </optgroup>
                        </select>
                      <div class="valid-feedback"> Please provide a multiple select.! </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="validationCustom03">Date Picker</label>
                        <div class="input-group">
                            <input type="text" name="Date" class="form-control drgpicker" placeholder="Enter inputdate" required>
                            <div class="input-group-append">
                                <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
                            </div>
                            <div class="invalid-feedback"> You must input date before submitting. </div>
                        </div>
                    </div>

                  </div>


                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="time-input2">Time Picker</label>
                        <div class="input-group">
                            <input type="text" class="form-control time-input" placeholder="Enter timeset" required>
                            <div class="invalid-feedback"> You must input Time before submitting. </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="simple-select2">Simple Select</label>
                        <select class="form-control select2" id="simple-select2" required>
                          <option selected disabled value="">Choose select...</option>
                          <optgroup label="Alaskan/Hawaiian Time Zone">
                            <option value="AK">Alaska</option>
                            <option value="HI">Hawaii</option>
                          </optgroup>
                          <optgroup label="Pacific Time Zone">
                            <option value="CA">California</option>
                            <option value="NV" disabled="disabled">Nevada (disabled)</option>
                            <option value="OR">Oregon</option>
                            <option value="WA">Washington</option>
                          </optgroup>
                        </select>
                        <div class="invalid-feedback"> Please select a valid simple. </div>
                    </div>

                   
                  </div>
                  <div class="form-group mb-3">
                    <label for="validationTextarea">About your self</label>
                    <textarea class="form-control" placeholder="Required example textarea" required></textarea>
                    <div class="invalid-feedback"> Please enter a message in the textarea. </div>
                  </div>

                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="radio-stacked" required>
                    <label class="custom-control-label" for="customControlValidation2">Toggle this custom radio</label>
                  </div>

                  <div class="custom-control custom-radio mb-3">
                    <input type="radio" class="custom-control-input" name="radio-stacked" required>
                    <label class="custom-control-label" for="customControlValidation3">Or toggle this other custom radio</label>
                    <div class="invalid-feedback">More example invalid feedback text</div>
                  </div>

                 
                  <div class="custom-file mb-3">
                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                    <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                  </div>

                  <div class="form-group mb-3">
                        <h5 class="card-title">Editor</h5>
                        <p>Pages type scale includes a range of contrasting styles that support the needs of your product and its content.</p>
                        <!-- Create the editor container -->
                        <div id="editor" style="min-height:100px;">
                            <textarea name="editor" required></textarea>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for=""><strong>Uppy</strong></label>
                            <div id="drag-drop-area"></div>
                    </div>
                  
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                      <label class="form-check-label" for="invalidCheck"> Agree to terms and conditions </label>
                      <div class="invalid-feedback"> You must agree before submitting. </div>
                    </div>
                  </div>

                  <button class="btn btn-primary" type="submit">Submit form</button>
                </form>
              </div> <!-- /.card-body -->
            </div> <!-- /.card -->
          </div> <!-- /.col -->
        </div> <!-- end section -->
      </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
    </div>
</div>
@endsection