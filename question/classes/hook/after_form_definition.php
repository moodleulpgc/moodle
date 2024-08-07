<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace core_question\hook;

use question_edit_form;
use MoodleQuickForm;

/**
 * Allows plugins to extend question form definition and add/remove/update form elements.
 *
 * @see question_edit_form::definition()
 *
 * @package    core_question
 * @copyright  2024 Enrique Castro, ULPGC
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class after_form_definition {
    /**
     * Creates new hook.
     *
     * @param question_edit_form $formwrapper Course form wrapper.
     * @param MoodleQuickForm $mform Form to be extended.
     */
    public function __construct(
        /** @var question_edit_form The form wrapper for the edit form */
        public readonly question_edit_form $formwrapper,
        /** @var MoodlequickForm The form to be extended */
        public readonly MoodleQuickForm $mform,
    ) {
    }
}
