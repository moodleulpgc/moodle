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
 * Hook callbacks for Moodle app tools
 *
 * @package    qbank_customfields
 * @copyright  2024 Enrique Castro, ULPGC
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$callbacks = [
    [
        'hook' => core_question\hook\after_form_definition::class,
        'callback' => 'qbank_customfields\local\hooks\question_edit_extensions::instance_form_definition',
        'priority' => 100,
    ],

    [
        'hook' => core_question\hook\after_form_definition_after_data::class,
        'callback' => 'qbank_customfields\local\hooks\question_edit_extensions::instance_form_definition_after_data',
        'priority' => 100,
    ],

    [
        'hook' => core_question\hook\after_form_submission::class,
        'callback' => 'qbank_customfields\local\hooks\question_edit_extensions::instance_form_save',
        'priority' => 100,
    ],

    [
        'hook' => core_question\hook\after_form_validation::class,
        'callback' => 'qbank_customfields\local\hooks\question_edit_extensions::instance_form_validation',
        'priority' => 100,
    ],
];
