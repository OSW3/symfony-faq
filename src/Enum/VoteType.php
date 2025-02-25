<?php
namespace OSW3\Faq\Enum;

enum VoteType: int
{
    case UPVOTE = 1;
    case DOWNVOTE = -1;
}
