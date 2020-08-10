@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="nav pb-5">
            <a class="nav-link" href="{{ url('/job_seeker') }}">Dashboard</a>
        </nav>
         <div class="form-group row">

                <label for="message" class="col-md-1 col-form-label text-md-right">Filter By:</label>
                
                <div class="form-group row px-3 mb-0">
                    <div class="form-check form-check-inline">
                        <input checked="true" class="form-check-input" type="radio" name="searchRadio" id="descriptionRadio" value="Search">
                        <label class="px-2 form-check-label" for="descriptionRadio">Description </label>

                        <input class="form-check-input" type="radio" name="searchRadio" id="categoryRadio" value="Search">
                        <label class="px-2 form-check-label" for="categoryRadio">Category</label>

                        <input class="form-check-input" type="radio" name="searchRadio" id="jobPostionRadio" value="Search">
                        <label class="px-2 form-check-label" for="jobPostionRadio">Job Position</label>

                        <input class="form-check-input" type="radio" name="searchRadio" id="salaryRadio" value="Search">
                        <label class="px-2 form-check-label" for="salaryRadio">Minimum Salary</label>
                    </div>
                </div>

                <label for="searchFilter" class="col-md-2 col-form-label text-md-right">Search Query</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="searchFilter" id="searchFilter" rows="3"></textarea>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button onclick="applySearch()" id="searchBtn" class="btn btn-primary">
                           Search
                        </button>
                    </div>
                </div>
            </div>

        <div class="row">
            <div class="col">
                <h3>Current Job Listing</h3>
                @if (isset($job_posts) && $job_posts->count() > 0)
                    <table id='jobTable' class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Category</th>
                            <th scope="col">Job Position</th>
                            <th scope="col">Description</th>
                            <th scope="col">Salary</th>
                            <th scope="col">Date Created</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($job_posts as $job_post)
                            <tr>
                                <td>{{ $job_post->category->name }}</td>
                                <td>{{ $job_post->position }}</td>
                                <td>{{ $job_post->description }}</td>
                                <td>{{ $job_post->salary }}</td>
                                <td>{{ $job_post->created_at }}</td>
                                <td>{{ $job_post->job_status->name }}</td>
                                <td><a href="{{ url('/job_seeker/job_posts/' . $job_post->id ) }}">Apply</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h5>No job listings yet.</h5>
                @endif
            </div>
        </div>
    </div>

    <script>
        var rows = document.getElementsByTagName("tr");
        for (i = 1; i < rows.length; i++) {
            rows[i].style.display="none";
        }

        function applySearch() {
          var descRadio = document.getElementById("descriptionRadio");
          var catRadio = document.getElementById("categoryRadio");
          var jobRadio = document.getElementById("jobPostionRadio");
          var salRadio = document.getElementById("salaryRadio");

          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("searchFilter");
          filter = input.value.toUpperCase();
          table = document.getElementById("jobTable");

          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            if (catRadio.checked){
                td = tr[i].getElementsByTagName("td")[0];
            }
            else if (descRadio.checked){
                td = tr[i].getElementsByTagName("td")[2];
            }
            else if (jobRadio.checked){
                td = tr[i].getElementsByTagName("td")[1];
            }
            else if (salRadio.checked){
                td = tr[i].getElementsByTagName("td")[3];
            }
            
            if (td) {
            
              txtValue = td.textContent || td.innerText;
              if (salRadio.checked){
                if (txtValue >= filter){
                    tr[i].style.display = "";
                }
                else
                {
                    tr[i].style.display = "none";
                }
                break;
              }

              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }
          }
        }
    </script>
@endsection
