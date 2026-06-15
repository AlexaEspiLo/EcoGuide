<div id="tipModal" class="tip-modal">
    <div class="tip-modal-content">
        <button class="tip-modal-close" type="button">&times;</button>

        <a href="#" class="author-info" id="modalAuthorLink">
            <img class="author-avatar" id="author-avatar" src="" alt="Author">
            <span id="modalAuthor"></span>
        </a>

        <div class="tip-detail-card">
            <h1 class="tip-title" id="modalTitle"></h1>

            <div class="description">
                <p class="tip-description" id="modalDescription"></p>

                <a href="" id="modalImageLink" data-fancybox data-caption="Tip Image">
                    <img class="tip-image" id="modalImage" src="" alt="Tip image">
                </a>
            </div>
        </div>
        <div class="comments-section">

    <h3>Comments</h3>

    <div id="modalComments" class="comments-list"></div>

    @auth
        <form id="commentForm" class="comment-form">
            @csrf

            <textarea
                name="content"
                id="commentContent"
                placeholder="Write a comment..."
                maxlength="500"
                required
            ></textarea>

            <button type="submit">
                Comment
            </button>
        </form>
    @else
        <p class="login-comment-message">
            Please log in to comment.
        </p>
    @endauth

</div>
    </div>
</div>