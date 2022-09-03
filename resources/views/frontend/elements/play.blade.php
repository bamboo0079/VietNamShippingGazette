<footer id="playerContainer">
    <div id="controlContainer" class="container">
        <div class="row flex-align-item play-controls">

            <div class="col col-left text-left">
                <button type="button" class="@if(isset($current_chapter->day) && $current_chapter->day ==1) disabled @endif btn btn-backward btnChangeChapter skip-link" data-action="back" onclick="$('#nextAction').val('back');$('#frm-comment').submit();"><i class="icon-play"></i><i class="icon-play"></i><span>前の章</span></button>
            </div>

            <div class="col-middle col-main-audio">
                <button type="button" class="btn btn-prev" data-attr="prevAudio"><i class="icon-play"></i><span>前の節</span></button>
                <button type="button" class="btn btn-play" data-attr="playPauseAudio"><i class="icon-play"></i></button>
                <button type="button" class="btn btn-next" data-attr="nextAudio"><i class="icon-play"></i><span>次の節</span></button>
            </div>
            <div class="col col-right text-right">
                <button type="button" class="btn btn-forward btnChangeChapter skip-link" data-action="next" data-target-element="#commentsModal"><i class="icon-play"></i><i class="icon-play"></i><span>次の章</span></button>
            </div>
        </div>
    </div>
</footer>