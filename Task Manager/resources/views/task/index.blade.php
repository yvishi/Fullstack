@extends('Layout.baseview')
@section('title','All Tasks')
@section('content')
    @include('Layout.navigation')
    <div class="container mt-5">
        <button type="button" class="btn btn-outline-primary mb-5 end-0" onclick="addTask()">Add Tasks</button>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th sco="col">Si. No</th>
                            <th sco="col">Task Description</th>
                            <th sco="col">Task Owner</th>
                            <th sco="col"> Task ETA</th>
                            <th sco="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="taskTable">
                        <tr>
                            <th scope="row">1</th>
                            <td>Task Description</td>
                            <td>Task Owner</td>
                            <td>ETA</td>
                            <td>
                                <i class="bi bi-pencil-square"></i>
                                <i class="bi bi-check2-square"></i>
                                <i class="bi bi-trash"></i>
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createTaskModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ADD Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form >
                        <div class="form-group p-3">
                            <label for="createTaskDescription"></label>
                            <input type="text" class="form control" id="createTaskDescription" placeholder="Enter Task Description">
                        </div>
                        <div class="form-group p-3">
                            <label for="createTaskOwner"></label>
                            <input type="text" class="form control" id="createTaskOwner" placeholder="Enter Task Owner">
                        </div>
                        <div class="form-group p-3">
                            <label for="createTaskEmail"></label>
                            <input type="text" class="form control" id="createTaskEmail" placeholder="Enter Task Owner Email">
                        </div>
                        <div class="form-group p-3">
                            <label for="createTaskETA"></label>
                            <input type="date" class="form control" id="createTaskETA" placeholder="Enter Task ETA">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="createTask()">Create</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
<script>
    $(document).ready(function(){
        getAllTasks();
    })
    function getAllTasks(){
        $.ajax({
            type:'get',
            url:'http://localhost:8000/api/task',
            success:function(result){
                var html='';
                for(var i=0;i<result.length;i++)
                {
                    html+='<tr>'
                            +'<th scope="row">'+(i+1)+'</th>'
                            +'<td>'+result[i]['task_description']+'</td>'
                            +'<td>'+result[i]['task_owner']+'</td>'
                            +'<td>'+result[i]['task_eta']+'</td>'
                            +'<td>'
                                +'<i class="bi bi-pencil-square" onclick="update('+result[i]['id']+')"></i>'
                                +'<i class="bi bi-check2-square"  onclick="markAsDone('+result[i]['id']+')"></i>'
                                +'<i class="bi bi-trash"  onclick="delete('+result[i]['id']+')"></i>'
                            +'</td>'
                            
                        +'</tr>'
                }
                $('#taskTable').html(html)
            },
            error:function(e){
                console.log(e.responseText)
            }
        })
       
    }
    function addTask(){
            $('#createTaskModal').modal('show');
        }
    
    function createTask(){
        var task_description=$("#createTaskDescription").val()
        var task_owner=$("#createTaskOwner").val()
        var task_owner_email=$("#createTaskEmail").val()
        var task_ETA=$("#createTaskETA").val()
        $.ajax({
            type:'get',
            url:'http://localhost:8000/api/task',
            data:{
                task_description:task_description,
                task_owner:task_owner,
                task_owner_email:task_owner_email,
                task_eta:task_ETA
            },
            success:function(){
                $("#createTaskModal").modal('hide');
                getAllTasks();
            },
            error:function(e){
                console.log(e.responseText)
            }
        })
    }
</script>
@endsection