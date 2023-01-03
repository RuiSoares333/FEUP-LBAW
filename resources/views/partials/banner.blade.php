<nav id="side-nav" class="d-none d-lg-inline col-lg-3 col-xl-2">
    <div class="masthead">
        <div class="masthead-content text-center text-capitalize text-light">
            <h4 class="mt-4">super legit collaborative news</h4>
            <h5 class="">Followed Tags</h5>
        </div>
        <div class="bg-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>
    </div>
    <ul>
        @each('partials.list_tag', Auth::user()->followed_tags(), 'tag')
    </ul>
        <button id="proposal" class="col-10 btn btn-primary rounded-pill py-2 text-light " onclick="toggleProposals()">Propose a New Tag</button>
        <button id="proposal_cancel" class="col-10 btn btn-primary rounded-pill py-2 text-light d-none" onclick="toggleProposals()">Cancel</button>

        <div id="tag_toggle">
        <section id="prop_toggle" class="flex d-flex justify-content-evenly d-none">
            <input id="prop_name" type="text" placeholder="New Tag" autocomplete=off class="form-control w-50" >
            <button id="proposal_submit" class="btn btn-primary rounded-pill py-2 text-light" onclick="sendProposal()">submit</button>
        </section>
        </div>


    <a href="{{ url('rte') }}" class="col-10 btn btn-primary rounded-pill border-0 py-2 px-4 text-light ">Share Your Story</button></a>
    <a href="{{ url('about_us') }}">About Us</a>
</nav>

<script>
    function toggleProposals(){
        const toggle = document.querySelector('#proposal')
        const cancel = document.querySelector('#proposal_cancel')
        const section = document.querySelector('#prop_toggle')
        const input = document.querySelector('#prop_name')

        toggle.classList.toggle('d-none')
        cancel.classList.toggle('d-none')
        section.classList.toggle('d-none')
        input.value = ""
    }

    async function sendProposal(){
        const input = document.querySelector('#prop_name')
        sendAjaxRequest('post', '/api/tag/propose', {'name':input.value})
        toggleProposals()
    }
</script>
