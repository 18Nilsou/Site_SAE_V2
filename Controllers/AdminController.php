<?php

final class AdminController
{
    public function defaultAction(): void
    {
        View::show("admin/admin");
    }
}