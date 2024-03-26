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

/**
 * Meta sync enrolments task.
 *
 * @package   qbank_customfields
 * @author    Enrique Castro <@ULPGC>
 * @copyright 2024 Enrique Castro
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace qbank_customfields\local\hooks;

use core_question\hook\after_form_definition;
use core_question\hook\after_form_definition_after_data;
use core_question\hook\after_form_submission;
use core_question\hook\after_form_validation;
use qbank_customfields\customfield\question_handler;

defined('MOODLE_INTERNAL') || die();

/**
 * Meta sync enrolments task.
 *
 * @package   qbank_customfields
 * @copyright 2024 Enrique Castro, ULPGC
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class question_edit_extensions {

    /**
     * Callback to add form elements.
     *
     * @param \core_question\hook\after_form_definition $hook
     */
    public static function instance_form_definition(after_form_definition $hook): void {
        $mform = $hook->mform;

        $questioncontext = $hook->formwrapper->get_context();
        $question = $hook->formwrapper->get_question();

        $handler = question_handler::create();
        $handler->instance_form_definition($mform, empty($question->id) ? 0 : $question->id);
    }

    /**
     * Callback to set data in form fields and complete definition.
     *
     * @param \core_question\hook\after_form_definition_after_data $hook
     */
    public static function instance_form_definition_after_data(after_form_definition_after_data $hook): void {
        global $DB;
        if (!get_config('qbank_customfields', 'version')) {
            return;
        }

        $questioncontext = $hook->formwrapper->get_context();
        //$contexts = $hook->formwrapper->get_contexts();
        $question = $hook->formwrapper->get_question();
        $handler = question_handler::create();

        $toform = fullclone($question);
        $handler->instance_form_before_set_data($toform);

        $hook->formwrapper->set_data($toform);

        $handler->instance_form_definition_after_data($hook->mform,
                                            empty($question->id) ? 0 : $question->id);
    }

    /**
     * Callback to save form elements values.
     *
     * @param \core_question\hook\after_form_submission $hook
     */
    public static function instance_form_save(after_form_submission $hook): void {
        global $DB;

        if (!get_config('qbank_customfields', 'version')) {
            return;
        }
        $data = $hook->get_data();

        $handler = question_handler::create();
        $handler->instance_form_save($data);
    }

    /**
     * Callback to validate form elements and identify errors.
     *
     * @param \core_question\hook\after_form_validation $hook
     */
    public static function instance_form_validation(after_form_validation $hook): void {
        if (!get_config('qbank_customfields', 'version')) {
            return;
        }

        $handler = question_handler::create();
        // Add the custom field validation.
        $errors = $handler->instance_form_validation($hook->get_data(), $hook->get_files());

        if(!empty($errors)) {
            $hook->add_errors($errors);
        }
   }
}
