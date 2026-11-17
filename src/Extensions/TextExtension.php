<?php

namespace Xefi\Faker\EnCa\Extensions;

use Xefi\Faker\Extensions\TextExtension as BaseTextExtension;

class TextExtension extends BaseTextExtension
{
    /**
     * The extension locale.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'en_CA';
    }

    protected array $paragraphs = [
        [
            ['Every', 'organization', 'benefits', 'from', 'a', 'clear', 'plan', 'and', 'honest', 'communication.'],
            ['Teams', 'from', 'coast', 'to', 'coast', 'share', 'their', 'progress', 'at', 'the', 'end', 'of', 'each', 'month.'],
            ['Bilingual', 'service', 'remains', 'a', 'priority', 'for', 'customers', 'across', 'the', 'country.'],
            ['Neighbours', 'and', 'partners', 'work', 'together', 'to', 'build', 'stronger', 'communities.'],
        ],
        [
            ['The', 'service', 'centre', 'stays', 'open', 'through', 'the', 'long', 'winter', 'months.'],
            ['Staff', 'analyze', 'feedback', 'carefully', 'before', 'changing', 'any', 'procedure.'],
            ['Small', 'improvements', 'to', 'daily', 'routines', 'often', 'make', 'the', 'biggest', 'difference.'],
            ['The', 'program', 'is', 'reviewed', 'every', 'spring', 'to', 'reflect', 'new', 'needs.'],
        ],
        [
            ['Labour', 'costs', 'and', 'travel', 'expenses', 'are', 'reviewed', 'every', 'quarter.'],
            ['Suppliers', 'are', 'paid', 'by', 'cheque', 'or', 'by', 'direct', 'deposit.'],
            ['Managers', 'make', 'safety', 'their', 'favourite', 'topic', 'at', 'every', 'meeting.'],
            ['Each', 'new', 'licence', 'is', 'recorded', 'in', 'the', 'central', 'catalogue.'],
        ],
        [
            ['Training', 'helps', 'employees', 'develop', 'skills', 'that', 'last', 'a', 'whole', 'career.'],
            ['Mentors', 'encourage', 'new', 'graduates', 'to', 'ask', 'questions', 'and', 'take', 'initiative.'],
            ['Flexible', 'schedules', 'let', 'people', 'balance', 'work', 'with', 'family', 'and', 'hockey.'],
            ['Good', 'behaviour', 'is', 'recognized', 'and', 'celebrated', 'by', 'the', 'whole', 'team.'],
        ],
        [
            ['Reliable', 'data', 'supports', 'better', 'decisions', 'and', 'clearer', 'priorities.'],
            ['Targets', 'are', 'adjusted', 'when', 'market', 'conditions', 'change.'],
            ['Regular', 'reviews', 'make', 'it', 'easier', 'to', 'respond', 'to', 'new', 'challenges.'],
            ['Customers', 'appreciate', 'friendly', 'and', 'practical', 'advice.'],
            ['Sustainable', 'growth', 'depends', 'on', 'steady', 'and', 'careful', 'progress.'],
        ],
    ];
}
