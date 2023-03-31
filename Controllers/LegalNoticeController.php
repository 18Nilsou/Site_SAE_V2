<?php

/**
 * LegalNoticeController is a controller class responsible for displaying legal notices
 */
final class LegalNoticeController {

    /**
     * Displays the privacy policy page
     *
     * @return void
     */
    public function defaultAction(): void {
        View::show("legalnotice/privacypolicy");
    }

    /**
     * Displays the general terms of use page
     *
     * @return void
     */
    public function generaltermsofuseAction(): void {
        View::show("legalnotice/generaltermsofuse");
    }
}
    