<?php

final class HomeController
{
    public function defaultAction(): void
    {
        View::show("home/home");
    }
}