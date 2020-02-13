@extends('layouts.master')

@section('content')

  
            
               


     
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><strong> Pending </strong></h3>
			</div>

			<div class="box-body">
				<table class="table table-responsive">
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
                                <td>{{$cat->email}}</td>
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
<script>
    
    $('.openPdf').on('click',function(event){
        event.preventDefault();
        window.location.href = "open-pdf?id="+this.id;

    });
</script>
@endsection