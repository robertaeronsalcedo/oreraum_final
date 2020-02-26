@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
@endsection

@section('content')

  
            
               


     
		<div class="box"style="box-shadow: 8px 5px 5px rgba(0,0,0,0.5)">
			<div class="box-header">
				<h3 class="box-title"><strong> Pending </strong></h3>
			</div>

			<div class="box-body">
				<table class="table table-responsive" id="tbl-manuscripts">
					<thead>
						<tr>
							<th>Title</th>
                            <th>Author</th>
                            <th>Date</th>
							<!-- <th>Date</th> -->
							<th>Action</th>
						</tr>
						
					</thead>

					<tbody>

						@foreach($manuscripts as $cat)
							<tr>
								<td>{{$cat->name}}</td>
                                <td>{{$cat->username}}</td>
                                <td>{{date('d-m-Y', strtotime($cat->created_at))}}</td>
                                

                                
								<td>
                <button class="btn btn-primary openPdf" id="{{$cat->id}}">Evaluate</button>
              

						@endforeach
					</tbody>


				</table>				
			</div>
		</div>
	</div>
@endsection

@section('js')
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    

</script>


	<script>
		$(document).ready(function() {
			$('#tbl-manuscripts').DataTable();

		    $('.openPdf').on('click',function(event){
		        event.preventDefault();
		        window.location.href = "open-pdf?id="+this.id;

		    });
		});
	</script>
@endsection