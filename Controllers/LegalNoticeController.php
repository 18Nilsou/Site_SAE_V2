<?php

final class LegalNoticeController{
    public function defaultAction(): void{
        View::show("legalnotice/privacypolicy");
    }
    public function generaltermsofuseAction(): void{
        View::show("legalnotice/generaltermsofuse");
    }
}
    