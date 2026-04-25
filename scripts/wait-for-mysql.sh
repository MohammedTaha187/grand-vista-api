#!/usr/bin/env sh

set -eu

max_attempts="${DB_WAIT_MAX_ATTEMPTS:-60}"
sleep_seconds="${DB_WAIT_SLEEP_SECONDS:-2}"
attempt=1

while [ "$attempt" -le "$max_attempts" ]; do
    if docker compose exec -T mysql sh -lc 'mysql -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" -e "USE testing; SELECT 1" >/dev/null 2>&1'; then
        exit 0
    fi

    echo "Waiting for MySQL authentication to be ready (attempt $attempt/$max_attempts)..."
    attempt=$((attempt + 1))
    sleep "$sleep_seconds"
done

echo "MySQL never became ready for authenticated access." >&2
exit 1
