#!/usr/bin/env python3
"""
Bakong KHQR Generator
Called by Laravel BakongController via shell_exec.
Usage: python bakong_generate.py '<json_input>'
Output: JSON to stdout
"""

import sys
import json
import traceback

def main():
    # Support both --file <path> and legacy positional JSON argument
    if len(sys.argv) >= 3 and sys.argv[1] == '--file':
        try:
            with open(sys.argv[2], 'r', encoding='utf-8') as f:
                params = json.load(f)
        except Exception as e:
            print(json.dumps({"success": False, "error": f"Cannot read file: {e}"}))
            sys.exit(1)
    elif len(sys.argv) >= 2:
        try:
            params = json.loads(sys.argv[1])
        except json.JSONDecodeError as e:
            print(json.dumps({"success": False, "error": f"Invalid JSON: {e}"}))
            sys.exit(1)
    else:
        print(json.dumps({"success": False, "error": "No input provided"}))
        sys.exit(1)

    try:
        from bakong_khqr import KHQR

        token        = params.get("token", "")
        action       = params.get("action", "generate")
        khqr         = KHQR(token)

        # ── Check payment ─────────────────────────────────────────────────────
        if action == "check":
            md5    = params.get("md5", "")
            status = khqr.check_payment(md5)
            print(json.dumps({
                "success": True,
                "paid":    status == "PAID",
                "status":  status,
            }))
            return

        # ── Generate QR ───────────────────────────────────────────────────────
        account_id    = params.get("account_id", "")
        merchant_name = params.get("merchant_name", "")
        merchant_city = params.get("merchant_city", "Phnom Penh")
        amount        = float(params.get("amount", 0))
        currency      = params.get("currency", "USD")
        bill_number   = params.get("bill_number", "")
        store_label   = params.get("store_label", "ROG Store")
        terminal_label = params.get("terminal_label", "online")

        khqr = KHQR(token)

        qr_string = khqr.create_qr(
            account_id    = account_id,
            merchant_name = merchant_name,
            merchant_city = merchant_city,
            amount        = amount,
            currency      = currency,
            store_label   = store_label,
            bill_number   = bill_number,
            terminal_label= terminal_label,
            static        = False,
            expiration    = 1,
        )

        md5 = khqr.generate_md5(qr_string)

        print(json.dumps({
            "success"   : True,
            "qr_string" : qr_string,
            "md5"       : md5,
        }))

    except Exception as e:
        print(json.dumps({
            "success": False,
            "error"  : str(e),
            "trace"  : traceback.format_exc(),
        }))
        sys.exit(1)

if __name__ == "__main__":
    main()
