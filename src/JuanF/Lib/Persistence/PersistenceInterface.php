<?php

/**
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * Copyright 2015 Juan Ferrari
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace JuanF\Lib\Persistence;

interface PersistenceInterface
{

    /**
     * Init backend
     * @param mixed $params Optional
     */
    static function init($params = null);

    /**
     * Get the given bits for the key.
     *
     * @param string $key
     * @param array $bits
     * @return array
     */
    function get($key, $value);

    /**
     * Set the given bit of the current key to 1.
     *
     * {@inheritDoc}
     * @see \JuanF\Lib\Persistence\PersistenceInterface::set()
     *
     * @param string $key
     * @param int $bit
     * @return
     */
    function set($key, $value);
}
