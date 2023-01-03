<script> 
    /*async function createTag(id){
        //Id is the id of the tag proposal
        sendAjaxRequest('post', '/api/tag/create', {'id':id})
    }*/
    
    async function createTag(id){
        const response = await fetch("/api/tag/create",  {
            method: 'post',
            headers:{
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                'csrf-token': document.querySelector('meta[name="csrf-token"]').content,
                'id': id
            })
        });
        const replies = await response.json();
        window.location.href = "{{ route('show_admin') }}";
    }

</script>

<article class="news col-xl-10 mx-auto my-4 p-3 d-flex flex-row border bg-light" data-id="{{ $tag_proposal->id }}">

    <nav id="tag_proposal-{{$tag_proposal->id}}" class="d-flex flex-column">   
        <p> {{$tag_proposal->tag_name}} </p>
        @if(!$tag_proposal->is_handled)
        <div id="accept{{$tag_proposal->id}}" onclick="createTag({{$tag_proposal->id}})">✔️</div>
        @endif
    </nav>

</article>

