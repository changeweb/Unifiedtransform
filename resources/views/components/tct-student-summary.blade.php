<div id = "student_summary" class="container row">
    <h3>{{$user->name}}</h3>
    <div class="col-md-6">
        <h5>
            {{($user->studentInfo->session == date('Y'))?'Registered':'Archived'}} 
            {{-- / {{($user->active)? 'Active' : 'Inactive'}} --}}
            
            @if ($user->active)
                {{($user->studentInfo->session == date('Y'))?'/ Active':'/ Graduated'}} 
            @else
                @php
                    $inactive_request = $user->inactive->sortByDesc('created_at')->first();
                    $inactive_type = $inactive_request->type;
                    $inactive_id = $inactive_request->id;
                    $reinstate = false;
                @endphp
                / Inactive / {{ucfirst($inactive_type)}} 
                @if(count($user->reinstate->where('inactive_id',$inactive_id)) > 0)
                    @php
                       $reinstate = true;
                       $reinstate_request = $user->reinstate->where('inactive_id',$inactive_id)->first();
                       $approved = $reinstate_request->approved;
                    @endphp
                    / Reinstated
                    @if($approved)
                        / Approved
                    @else
                        / <b class="text-danger"> Not Approved</b>
                    @endif
                     {{-- ({{($approved)?' Approved': <div class="text-danger">Not Approved</div>}})</ --}}
                @endif    
            @endif

            / {{ucfirst($user->studentInfo->group)}}

        </h5>
    </div>
</div>
